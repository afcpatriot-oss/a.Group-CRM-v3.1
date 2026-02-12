<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [update] process for the orders
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Orders;
use Illuminate\Contracts\Support\Responsable;

class ArchiveRestoreResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for team members
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        $jsondata = [];

        //update initiated on a list page
        if (request('ref') == 'list') {
            foreach ($orders as $order) {
                //hide anywany
                if ($action == 'archive' && auth()->user()->pref_filter_show_archived_orders == 'no') {
                    $jsondata['dom_visibility'][] = [
                        'selector' => '#order_' . $order->order_id,
                        'action' => 'hide',
                    ];
                } else {
                    //replace row
                    $html = view('pages/orders/components/table/ajax-inc', compact('order'))->render();
                    $jsondata['dom_html'][] = [
                        'selector' => '#order_' . $order->order_id,
                        'action' => 'replace-with',
                        'value' => $html,
                    ];
                }
            }
            //notice
            $jsondata['notification'] = array('type' => 'success', 'value' => __('lang.request_has_been_completed'));
        }

        //editing from main page
        if (request('ref') == 'page') {
            //session
            request()->session()->flash('success-notification', __('lang.request_has_been_completed'));
            //redirect to order page
            $jsondata['redirect_url'] = url("orders/" . $orders->first()->order_id);
        }

        //response
        return response()->json($jsondata);
    }

}
