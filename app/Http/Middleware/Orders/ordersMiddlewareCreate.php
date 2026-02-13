<?php

/** --------------------------------------------------------------------------------
 * This middleware class handles [create] precheck processes for orders
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Middleware\Orders;
use Closure;
use Log;

class ordersMiddlewareCreate {

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        //frontend
        $this->fronteEnd();

        //permission: does user have permission create orders
        if (auth()->user()->role->role_orders >= 2) {
            return $next($request);
        }

        //permission denied
        Log::error("permission denied", ['process' => '[permissions][orders][create]', 'ref' => config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
        abort(403);
    }

    private function fronteEnd() {
        //reserved
    }
}
