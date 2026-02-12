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

        $jsondata = [];

        $container = view('pages.orders.components.card.container')->render();
        $content = view('pages.orders.components.card.content')->render();
        $tabmenu = view('pages.orders.components.card.tabmenu', compact('order'))->render();
        $leftpanel = view('pages.orders.components.modals.show', compact('order'))->render();
        $rightpanel = view('pages.orders.components.card.rightpanel', compact('order'))->render();

        $jsondata['dom_html'][] = [
            'selector' => '#cardModalContainer',
            'action' => 'replace-with',
            'value' => $container,
        ];

        $jsondata['dom_html'][] = [
            'selector' => '#cardModalContent',
            'action' => 'replace-with',
            'value' => $content,
        ];

        $jsondata['dom_html'][] = [
            'selector' => '#cardModalTabMenu',
            'action' => 'replace',
            'value' => $tabmenu,
        ];

        $jsondata['dom_html'][] = [
            'selector' => '#card-orders-left-panel',
            'action' => 'replace',
            'value' => $leftpanel,
        ];

        $jsondata['dom_html'][] = [
            'selector' => '#card--orders-right-panel',
            'action' => 'replace',
            'value' => $rightpanel,
        ];

        $jsondata['dom_classes'][] = [
            'selector' => '#cardModalContent',
            'action' => 'remove',
            'value' => 'hidden',
        ];

        $jsondata['dom_visibility'][] = [
            'selector' => '#cardModal',
            'action' => 'show',
        ];

        return response()->json($jsondata);
    }
}
