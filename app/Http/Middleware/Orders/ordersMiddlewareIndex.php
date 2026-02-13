<?php

/** --------------------------------------------------------------------------------
 * This middleware class handles [index] precheck processes for orders
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Middleware\Orders;

use Closure;
use Log;

class ordersMiddlewareIndex {

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        //various frontend and visibility settings
        $this->fronteEnd();

        //client user permission
        if (auth()->user()->is_client) {
            return $next($request);
        }

        //team user permission
        if (auth()->user()->is_team) {
            if (auth()->user()->role->role_orders >= 1) {
                if(auth()->user()->role->role_orders >= 3){
                    config(['visibility.action_buttons_delete' => true]);
                }

                if(auth()->user()->role->role_orders >= 2){
                    config(['visibility.action_buttons_edit' => true]);
                }

                return $next($request);
            }
        }

        //permission denied
        Log::error("permission denied", ['process' => '[permissions][orders][index]', 'ref' => config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
        abort(403);
    }

    private function fronteEnd() {

        request()->merge([
            'resource_query' => 'ref=list',
        ]);

        //default columns
        config([
            'visibility.orders_col_id' => true,
            'visibility.orders_col_client' => true,
        ]);

        //permissions -viewing
        if (auth()->user()->role->role_orders >= 1) {
            if (auth()->user()->is_team) {
                config([
                    'visibility.list_page_actions_filter_button' => true,
                    'visibility.list_page_actions_search' => true,
                    'visibility.orders_col_action' => true,
                    'visibility.show_contact_profile' => true,
                ]);
            }
            if (auth()->user()->is_client) {
                config([
                    'visibility.list_page_actions_search' => true,
                    'visibility.list_page_actions_add_button_link' => true,
                    'visibility.orders_col_client' => false,
                    'visibility.show_contact_profile' => false,
                ]);
            }
        }

        //permissions -adding/editing
        if (auth()->user()->role->role_orders >= 2) {
            config([
                'visibility.list_page_actions_add_button_link' => true,
                'visibility.action_buttons_edit' => true,
                'visibility.orders_col_checkboxes' => true,
            ]);

            if (auth()->user()->is_client) {
                config([
                    'visibility.action_buttons_edit' => false,
                ]);
            }
        }

        //permissions -deleting
        if (auth()->user()->role->role_orders >= 3) {
            config([
                'visibility.action_buttons_delete' => true,
                'visibility.orders_col_checkboxes' => true,
            ]);
        }

        //update 'archived orders filter'
        if (request('toggle') == 'pref_filter_show_archived_orders') {
            auth()->user()->pref_filter_show_archived_orders = (auth()->user()->pref_filter_show_archived_orders == 'yes') ? 'no' : 'yes';
            auth()->user()->save();
        }

        if (request('search_type') == 'filter') {
            if (request('show_archive_orders') == 'on') {
                request()->merge(['filter_show_archived_orders' => 'yes']);
                auth()->user()->pref_filter_show_archived_orders = 'yes';
                auth()->user()->save();
            } else {
                auth()->user()->pref_filter_show_archived_orders = 'no';
                auth()->user()->save();
            }
        }

        if (request('search_type') != 'filter' || !request()->filled('search_type')) {
            if (auth()->user()->pref_filter_show_archived_orders == 'yes') {
                request()->merge(['filter_show_archived_orders' => 'yes']);
            }
        }

        if (auth()->user()->is_team) {
            config([
                'visibility.archived_orders_toggle_button' => true,
            ]);
        }
    }
}
