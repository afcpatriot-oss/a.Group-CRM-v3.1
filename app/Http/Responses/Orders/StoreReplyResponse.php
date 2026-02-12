<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [store reply] process for the orders
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Orders;
use Illuminate\Contracts\Support\Responsable;

class StoreReplyResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for orders
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //prepend use on top of list
        $html = view('pages/order/components/replies', compact('replies'))->render();
        $jsondata['dom_html'][] = array(
            'selector' => '#order-replies-container',
            'action' => 'append',
            'value' => $html);

        //update left panel
        $html = view('pages/order/components/panel', compact('order', 'fields'))->render();
        $jsondata['dom_html'][] = array(
            'selector' => "#order-left-panel",
            'action' => 'replace-with',
            'value' => $html);

        //close modal
        $jsondata['dom_visibility'][] = array('selector' => '#commonModal', 'action' => 'close-modal');

        //inline replies
        if (request('view') == 'inline') {
            $jsondata['dom_visibility'][] = [
                'selector' => '#order_reply_inline_form',
                'action' => 'hide',
            ];
            $jsondata['dom_visibility'][] = [
                'selector' => '#order_replay_button_inline_container',
                'action' => 'show',
            ];
        }

        //response
        return response()->json($jsondata);

    }

}
