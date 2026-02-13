<?php

namespace App\Listeners\Orders\Responses;

use App\Events\Orders\Responses\OrderIndex;

class OrderIndexListener
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\Orders\Responses\OrderIndex  $event
     * @return void
     */
    public function handle(OrderIndex $event)
    {
        if (!isset($event->payload['page']) || !is_array($event->payload['page'])) {
            $event->payload['page'] = [];
        }

        if (!isset($event->payload['page']['visibility']) || !is_array($event->payload['page']['visibility'])) {
            $event->payload['page']['visibility'] = [];
        }

        $event->payload['page']['visibility'] = array_merge($event->payload['page']['visibility'], [
            'list_page_actions_search' => true,
            'list_page_actions_add_button' => true,
            'list_page_actions_filter_button' => true,
            'list_page_actions_exporting' => true,
            'archived_orders_toggle_button' => true,
            'stats_toggle_button' => true,
        ]);
    }
}
