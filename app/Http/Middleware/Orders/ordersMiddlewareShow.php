<?php

/** --------------------------------------------------------------------------------
 * This middleware class handles [show] precheck processes for orders
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Middleware\Orders;
use Closure;
use Log;

class ordersMiddlewareShow {

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        //order id
        $order_id = $request->route('order');

        //does the order exist
        if ($order_id == '' || !$order = \App\Models\Order::where('id', $order_id)->first()) {
            abort(404);
        }

        //frontend
        $this->fronteEnd($order);

        //team: permission view
        if (auth()->user()->is_team) {
            if (auth()->user()->role->role_orders >= 1) {
                return $next($request);
            }
        }

        //client: permission view own order
        if (auth()->user()->is_client) {
            if ((int) $order->client_id === (int) auth()->user()->clientid) {
                if (auth()->user()->role->role_orders >= 1) {
                    return $next($request);
                }
            }
        }

        Log::error("permission denied", ['process' => '[permissions][orders][show]', 'ref' => config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'order id' => $order_id ?? '']);
        abort(403);
    }

    private function fronteEnd($order) {
        if (auth()->user()->is_team) {
            config([
                'visibility.show_contact_profile' => true,
            ]);

            if (auth()->user()->role->role_orders >= 2) {
                config([
                    'visibility.action_buttons_edit' => true,
                ]);
            }
        }

        if (auth()->user()->is_client) {
            config([
                'visibility.show_contact_profile' => false,
            ]);
        }
    }
}
