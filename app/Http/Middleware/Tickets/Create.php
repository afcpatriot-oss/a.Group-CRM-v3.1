<?php

/** --------------------------------------------------------------------------------
 * This middleware class handles [create] precheck processes for tickets
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Middleware\Tickets;
use App\Models\Client;
use Closure;
use DB;
use Log;
use Throwable;

class Create {

    /**
     * This middleware does the following
     *   2. checks users permissions to [view] tickets
     *   3. modifies the request object as needed
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        //validate module status
        if (!config('visibility.modules.tickets')) {
            abort(404, __('lang.the_requested_service_not_found'));
            return $next($request);
        }

        //frontend
        $this->fronteEnd();

        //permission: does user have permission create tickets
        if (auth()->user()->role->role_tickets >= 2) {

            //resolve a client for quick order flow before validation
            if ($this->shouldRunQuickOrderClientResolution($request)) {
                return $this->handleQuickOrderFlow($request, $next);
            }

            return $next($request);
        }

        //permission denied
        Log::error("permission denied", ['process' => '[permissions][tickets][create]', 'ref' => config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
        abort(403);
    }

    /*
     * various frontend and visibility settings
     */
    private function fronteEnd() {

        
        //client prefill
        if (auth()->user()->is_client) {
            request()->merge([
                'ticket_priority' => 'normal',
                'ticket_clientid' => auth()->user()->clientid,
            ]);
        }


    }

    /**
     * run quick order logic only for explicitly flagged requests
     * @param object $request
     * @return bool
     */
    private function shouldRunQuickOrderClientResolution($request) {

        if ($request->getMethod() != 'POST') {
            return false;
        }

        $quick_order_flags = [
            'quick_order',
            'ticket_quick_order',
            'is_quick_order',
        ];

        foreach ($quick_order_flags as $flag) {
            if ($request->filled($flag) && in_array((string) $request->input($flag), ['1', 'true', 'yes', 'on'])) {
                return true;
            }
        }

        return false;
    }

    /**
     * wraps quick-order client resolve/create + ticket store in one transaction
     * @param object $request
     * @param object $next
     * @return mixed
     */
    private function handleQuickOrderFlow($request, $next) {

        DB::beginTransaction();

        try {
            $this->resolveQuickOrderClient($request);

            $response = $next($request);

            //if we got here without an exception, preserve created resources
            DB::commit();

            return $response;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * resolve existing client by phone or create a new one and merge ticket_clientid
     * @param object $request
     * @return void
     */
    private function resolveQuickOrderClient($request) {

        $phone = $this->extractQuickOrderPhone($request);

        //respect existing explicit selection from regular flow when no quick-order phone was sent
        if ($request->filled('ticket_clientid') && $phone == '') {
            return;
        }
        if ($phone == '') {
            return;
        }

        $normalized_phone = $this->normalizePhone($phone);
        if ($normalized_phone == '') {
            return;
        }

        //lock matching rows first to reduce race conditions
        $matching_clients = Client::where('client_phone', $normalized_phone)
            ->lockForUpdate()
            ->orderBy('client_id', 'asc')
            ->get();

        if ($matching_clients->count() > 0) {
            request()->merge([
                'ticket_clientid' => $matching_clients->first()->client_id,
            ]);
            return;
        }

        //fallback lock to avoid duplicate client creation by concurrent quick-orders
        $lock_name = 'quick-order-client-' . md5($normalized_phone);
        $supports_advisory_lock = in_array(DB::connection()->getDriverName(), ['mysql', 'mariadb']);

        if ($supports_advisory_lock) {
            DB::select('SELECT GET_LOCK(?, 10) AS quick_order_lock', [$lock_name]);
        }

        try {
            $existing_client = Client::where('client_phone', $normalized_phone)
                ->lockForUpdate()
                ->orderBy('client_id', 'asc')
                ->first();

            if ($existing_client) {
                request()->merge([
                    'ticket_clientid' => $existing_client->client_id,
                ]);
                return;
            }

            $client = new Client();
            $client->client_creatorid = auth()->id() ?? 0;
            $client->client_company_name = $this->deriveQuickOrderClientName($request);
            $client->client_phone = $normalized_phone;
            $client->client_categoryid = 2;
            $client->client_status = 'active';
            $client->client_created = now();
            $client->save();

            request()->merge([
                'ticket_clientid' => $client->client_id,
            ]);
        } finally {
            if ($supports_advisory_lock) {
                DB::select('SELECT RELEASE_LOCK(?)', [$lock_name]);
            }
        }
    }

    /**
     * normalize phone into a canonical lookup format
     * @param string $phone
     * @return string
     */
    private function normalizePhone($phone) {
        $phone = trim((string) $phone);
        if ($phone == '') {
            return '';
        }

        $has_plus_prefix = substr($phone, 0, 1) === '+';
        $digits = preg_replace('/\D+/', '', $phone);

        if ($digits == '') {
            return '';
        }

        if ($has_plus_prefix) {
            return '+' . $digits;
        }

        return $digits;
    }

    /**
     * find quick-order phone value from known request keys
     * @param object $request
     * @return string
     */
    private function extractQuickOrderPhone($request) {
        $phone_fields = [
            'quick_order_phone',
            'ticket_quick_order_phone',
            'client_phone',
            'ticket_phone',
            'phone',
        ];

        foreach ($phone_fields as $field) {
            if ($request->filled($field)) {
                return (string) $request->input($field);
            }
        }

        return '';
    }

    /**
     * derive client company name from quick-order inputs
     * @param object $request
     * @return string
     */
    private function deriveQuickOrderClientName($request) {
        $name_fields = [
            'quick_order_name',
            'ticket_quick_order_name',
            'client_company_name',
            'ticket_customer_name',
            'name',
        ];

        foreach ($name_fields as $field) {
            if ($request->filled($field)) {
                return trim((string) $request->input($field));
            }
        }

        return $this->normalizePhone($this->extractQuickOrderPhone($request));
    }
}
