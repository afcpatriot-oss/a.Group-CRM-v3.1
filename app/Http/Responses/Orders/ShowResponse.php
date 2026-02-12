<?php

namespace App\Http\Responses\Orders;

use Illuminate\Contracts\Support\Responsable;

class ShowResponse implements Responsable
{
    private $payload;

    public function __construct($payload = [])
    {
        $this->payload = $payload;
    }

    public function toResponse($request)
    {
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        $html = view('pages.orders.components.modals.show', compact('order'))->render();

        return response()->json([
            'dom_html' => [
                [
                    'selector' => '#cardModalBody',
                    'action' => 'replace',
                    'value' => $html,
                ],
            ],
            'dom_visibility' => [
                [
                    'selector' => '#cardModal',
                    'action' => 'show',
                ],
            ],
            'modal_title' => cleanLang(__('lang.order')) . ' ' . ($order->order_number ?? ('#' . $order->id)),
        ]);
    }
}
