<?php

namespace App\Http\Responses\Orders;

use Illuminate\Contracts\Support\Responsable;

class CreateResponse implements Responsable
{
    public function toResponse($request)
    {
        $html = view('pages.orders.components.modals.create')->render();

        return response()->json([
            'dom_html' => [
                [
                    'selector' => '#commonModalBody',
                    'action' => 'replace',
                    'value' => $html,
                ],
            ],
            'dom_visibility' => [
                [
                    'selector' => '#commonModal',
                    'action' => 'show',
                ],
            ],
            'modal_title' => 'Create Order',
        ]);
    }
}
