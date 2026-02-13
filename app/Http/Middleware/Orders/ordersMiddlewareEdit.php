<?php

/** --------------------------------------------------------------------------------
 * This middleware class handles [edit] precheck processes for orders
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Middleware\Orders;
use Closure;
use Log;

class ordersMiddlewareEdit {

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
            Log::error("order could not be found", ['process' => '[permissions][orders][edit]', 'ref' => config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'order id' => $order_id ?? '']);
            abort(409, __('lang.order_not_found'));
        }

        //permission: does user have permission edit orders
        if (auth()->user()->is_team) {
            if (auth()->user()->role->role_orders >= 2) {
                return $next($request);
            }
        }

        //client: does user have permission edit orders
        if (auth()->user()->is_client) {
            if ((int) $order->client_id === (int) auth()->user()->clientid) {
                return $next($request);
            }
        }

        //permission denied
        Log::error("permission denied", ['process' => '[permissions][orders][edit]', 'ref' => config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
        abort(403);
    }
}
