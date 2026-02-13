<?php

namespace App\Http\Responses\Orders;

use Illuminate\Contracts\Support\Responsable;

class IndexResponse implements Responsable
{
    private $payload;

    public function __construct($payload = [])
    {
        $this->payload = $payload;
    }

    public function toResponse($request)
    {
        // set all data to local vars
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        $this->visibility = [
            'list-page-actions' => 'show',
        ];

        // SAFETY: stats must always exist (even empty)
        if (!isset($stats)) {
            $stats = [];
        }

        // if filtering with remember checked, or clearing filter, redirect to reload page
        if ((request('query-type') == 'filter' && request()->filled('filter_remember')) || request('clear-filter') == 'yes') {
            $jsondata['redirect_url'] = url('/orders');
            return response()->json($jsondata);
        }

        // embedded/ajax/search
        if (request('source') == 'ext' || request('action') == 'search' || request()->ajax()) {

            switch (request('action')) {

                // load more
                case 'load':
                    $template = 'pages/orders/components/table/ajax';
                    $dom_container = '#orders-td-container';
                    $dom_action = 'append';
                    break;

                // sorting
                case 'sort':
                    $template = 'pages/orders/components/table/ajax';
                    $dom_container = '#orders-td-container';
                    $dom_action = 'replace';
                    break;

                // search/filter panel
                case 'search':
                    $template = 'pages/orders/components/table/table';
                    $dom_container = '#orders-table-wrapper';
                    $dom_action = 'replace-with';
                    break;

                // initial embedded load
                default:
                    $template = 'pages/orders/tabswrapper';
                    $dom_container = '#embed-content-container';
                    $dom_action = 'replace';
                    break;
            }

            // load more button logic (only if you use paginator like tickets)
            if (isset($orders) && method_exists($orders, 'currentPage') && method_exists($orders, 'lastPage')) {
                if ($orders->currentPage() < $orders->lastPage()) {
                    $url = loadMoreButtonUrl($orders->currentPage() + 1, request('source'));
                    $jsondata['dom_attributes'][] = [
                        'selector' => '#load-more-button',
                        'attr' => 'data-url',
                        'value' => $url,
                    ];
                    $jsondata['dom_visibility'][] = ['selector' => '.loadmore-button-container', 'action' => 'show'];
                    $page['visibility_show_load_more'] = true;
                    $page['url'] = $url;
                } else {
                    $jsondata['dom_visibility'][] = ['selector' => '.loadmore-button-container', 'action' => 'hide'];
                }
            }

            // flip sorting url (if you use sorting links)
            if (request('action') == 'sort') {
                $sort_url = flipSortingUrl(request()->fullUrl(), request('sortorder'));
                $element_id = '#sort_' . request('orderby');
                $jsondata['dom_attributes'][] = [
                    'selector' => $element_id,
                    'attr' => 'data-url',
                    'value' => $sort_url,
                ];
            }

            // RENDER (IMPORTANT: include stats even if empty)
            $html = view($template, compact('page', 'orders', 'stats', 'fields', 'statuses'))->render();

            $jsondata['dom_html'][] = [
                'selector' => $dom_container,
                'action' => $dom_action,
                'value' => $html,
            ];

            // for embedded request - breadcrumb title
            $jsondata['dom_html'][] = [
                'selector' => '.active-bread-crumb',
                'action' => 'replace',
                'value' => strtoupper(__('lang.orders')),
            ];

            // for embedded request - change active tab
            $jsondata['dom_classes'][] = [
                'selector' => '.tabs-menu-item',
                'action' => 'remove',
                'value' => 'active',
            ];
            $jsondata['dom_classes'][] = [
                'selector' => '#tabs-menu-orders',
                'action' => 'add',
                'value' => 'active',
            ];

            // skip reset of filter panel
            if (request('action') == 'search') {
                $jsondata['skip_dom_reset'] = true;
            }

            return response()->json($jsondata);
        }

        // standard view (IMPORTANT: include stats even if empty)
        if (isset($orders) && method_exists($orders, 'currentPage') && method_exists($orders, 'lastPage')) {
            $page['url'] = loadMoreButtonUrl($orders->currentPage() + 1, request('source'));
            $page['loading_target'] = 'orders-td-container';
            $page['visibility_show_load_more'] = ($orders->currentPage() < $orders->lastPage()) ? true : false;
        }

        return view('pages/orders/wrapper', compact('page', 'orders', 'stats', 'fields', 'statuses'))->render();
    }
}
