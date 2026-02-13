<?php

/** --------------------------------------------------------------------------------
 * Event fired when order index page is being rendered
 * Allows modules to extend the page with additional data and blade stacks
 *----------------------------------------------------------------------------------*/

namespace App\Events\Orders\Responses;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderIndex {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $request;
    public $payload;

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $payload
     */
    public function __construct($request, &$payload) {
        $this->request = $request;
        $this->payload = &$payload;
    }
}
