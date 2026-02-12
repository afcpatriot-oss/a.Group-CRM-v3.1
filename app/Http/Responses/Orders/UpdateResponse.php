<?php

namespace App\Http\Responses\Orders;

use Illuminate\Contracts\Support\Responsable;

class UpdateResponse implements Responsable
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

        $html = view('pages.orders.components.table.ajax', [
            'orders' => collect([$order])
        ])->render();

        return response()->json([
            'dom_html' => [
                [
                    'selector' => '#order_' . $order->id,
                    'action'   => 'replace-with',
                    'value'    => $html,
                ],
            ],
            'dom_visibility' => [
                [
                    'selector' => '#commonModal',
                    'action'   => 'close',
                ],
            ],
            'notification' => [
                'type'  => 'success',
                'value' => cleanLang(__('lang.order')) . ' ' . cleanLang(__('lang.updated')),
            ],
        ]);
    }
}
