<?php

/** --------------------------------------------------------------------------------
 * This middleware class handles [destroy] precheck processes for orders
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Middleware\Orders;
use Closure;
use Log;

class ordersMiddlewareDestroy {

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        //for a single item request - merge into an $ids[x] array and set as if checkox is selected (on)
        if (is_numeric($request->route('order'))) {
            $ids[$request->route('order')] = 'on';
            request()->merge([
                'ids' => $ids,
            ]);
        }

        //loop through each order and check permissions
        if (is_array(request('ids'))) {

            //validate each item in the list exists
            foreach (request('ids') as $id => $value) {
                if ($value == 'on') {
                    if (!$order = \App\Models\Order::where('id', $id)->first()) {
                        abort(409, __('lang.one_of_the_selected_items_nolonger_exists'));
                    }
                }
            }

            //permission: does user have permission delete orders
            if (auth()->user()->is_team) {
                if (auth()->user()->role->role_orders < 3) {
                    abort(403, __('lang.permission_denied_for_this_item') . " - #$id");
                }
            }

            //client - no permissions
            if (auth()->user()->is_client) {
                abort(403);
            }
        } else {
            Log::error("no items were sent with this request", ['process' => '[permissions][orders][action-bar]', 'ref' => config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'order id' => $order_id ?? '']);
            abort(409);
        }

        return $next($request);
    }
}
