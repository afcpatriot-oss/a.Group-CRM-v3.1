<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [edit] process for the orders
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Orders;
use Illuminate\Contracts\Support\Responsable;

class UpdateReplyResponse implements Responsable {

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

        //clear the text editor
        $jsondata['dom_html'][] = array(
            'selector' => '#order_edit_reply_container_' . $reply->orderreply_id,
            'action' => 'replace',
            'value' => '');

        //hide the text editor
        $jsondata['dom_visibility'][] = [
            'selector' => '#order_edit_reply_container_' . $reply->orderreply_id,
            'action' => 'hide',
        ];

        //update reply text
        $jsondata['dom_html'][] = array(
            'selector' => '#order_reply_text_' . $reply->orderreply_id,
            'action' => 'replace',
            'value' => $reply->orderreply_text);

        //show the reply text
        $jsondata['dom_visibility'][] = [
            'selector' => '#order_reply_text_' . $reply->orderreply_id,
            'action' => 'show',
        ];

        //ajax response
        return response()->json($jsondata);
    }

}
