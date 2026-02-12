<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [closeOrder] process for the orders
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Orders;
use Illuminate\Contracts\Support\Responsable;

class CloseOrderResponse implements Responsable {

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

        //session
        request()->session()->flash('success-notification', __('lang.request_has_been_completed'));

        //redirect to orders list
        $jsondata['redirect_url'] = url('orders');

        //response
        return response()->json($jsondata);
    }

}
