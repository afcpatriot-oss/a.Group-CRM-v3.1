<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\Orders\IndexResponse;
use App\Http\Responses\Orders\CreateResponse;
use App\Http\Responses\Orders\StoreResponse;
use App\Http\Responses\Orders\ShowResponse;
use App\Http\Responses\Orders\EditResponse;
use App\Http\Responses\Orders\UpdateResponse;
use App\Http\Responses\Orders\DestroyResponse;
use App\Http\Responses\Orders\ChangeStatusResponse;
use App\Http\Responses\Orders\ArchiveRestoreResponse;

use App\Repositories\OrderRepository;
use App\Repositories\TagRepository;
use App\Repositories\CustomFieldsRepository;

use Illuminate\Http\Request;

class Orders extends Controller
{
    protected $orderrepo;
    protected $tagrepo;
    protected $customrepo;

    public function __construct(
        OrderRepository $orderrepo,
        TagRepository $tagrepo,
        CustomFieldsRepository $customrepo
    ) {
        parent::__construct();

        $this->middleware('auth');

        $this->orderrepo = $orderrepo;
        $this->tagrepo = $tagrepo;
        $this->customrepo = $customrepo;
    }

    /* ===================================================
       INDEX
    =================================================== */

    public function index()
    {
        $orders = $this->orderrepo->search();

        // безопасная заглушка
        $stats = [];

        $statuses = \App\Models\OrderStatus::orderBy('sort_order', 'asc')->get();

        $payload = [
            'page'     => $this->pageSettings(),
            'orders'   => $orders,
            'stats'    => $stats,
            'statuses' => $statuses,
            'fields'   => $this->getCustomFields(),
        ];

        return new IndexResponse($payload);
    }

    /* ===================================================
       CREATE
    =================================================== */

    public function create()
    {
        $tags = $this->tagrepo->getByType('order');

        $payload = [
            'page'   => $this->pageSettings(),
            'tags'   => $tags,
            'fields' => $this->getCustomFields(),
        ];

        return new CreateResponse($payload);
    }

    /* ===================================================
       STORE
    =================================================== */

    public function store(Request $request)
    {
        if (!$order_id = $this->orderrepo->create()) {
            abort(409);
        }

        $this->tagrepo->add('order', $order_id);

        return new StoreResponse([
            'order_id' => $order_id,
        ]);
    }

    /* ===================================================
       SHOW
    =================================================== */

    public function show($id)
    {
        $orders = $this->orderrepo->search($id);

        if (!$order = $orders->first()) {
            abort(409, __('lang.order_not_found'));
        }

        $payload = [
            'page' => $this->pageSettings(),
            'order' => $order,
            'fields' => $this->getCustomFields($order),
        ];

        return new ShowResponse($payload);
    }

    /* ===================================================
       EDIT
    =================================================== */

    public function edit($id)
    {
        $orders = $this->orderrepo->search($id);

        if (!$order = $orders->first()) {
            abort(404);
        }

        $statuses = \App\Models\OrderStatus::orderBy('sort_order', 'asc')->get();

        return new EditResponse([
            'order'    => $order,
            'statuses' => $statuses,
            'fields'   => $this->getCustomFields($order),
        ]);
    }

    /* ===================================================
       UPDATE
    =================================================== */

    public function update(Request $request, $id)
    {
        if (!$this->orderrepo->update($id)) {
            abort(409);
        }

        $orders = $this->orderrepo->search($id);

        return new UpdateResponse([
            'orders'   => $orders,
            'order_id' => $id,
        ]);
    }

    /* ===================================================
       DESTROY (bulk)
    =================================================== */

    public function destroy()
    {
        if (is_array(request('ids'))) {
            foreach (request('ids') as $id => $value) {
                if ($value == 'on') {
                    $this->orderrepo->delete($id);
                }
            }
        }

        return new DestroyResponse([]);
    }

    /* ===================================================
       CHANGE STATUS
    =================================================== */

    public function changeStatus()
    {
        $statuses = \App\Models\OrderStatus::orderBy('sort_order', 'asc')->get();

        return new ChangeStatusResponse([
            'statuses' => $statuses,
        ]);
    }

    public function changeStatusUpdate()
    {
        if (is_array(request('ids'))) {
            foreach (request('ids') as $id => $value) {
                if ($value == 'on') {
                    \App\Models\Order::where('id', $id)
                        ->update(['status_id' => request('status_id')]);
                }
            }
        }

        $orders = $this->orderrepo->search();

        return new ChangeStatusResponse([
            'orders' => $orders,
            'action' => 'update',
        ]);
    }

    /* ===================================================
       ARCHIVE / RESTORE
    =================================================== */

    public function archive()
    {
        // если у тебя нет active_state — ничего не делаем
        return new ArchiveRestoreResponse([
            'action' => 'archive',
        ]);
    }

    public function restore()
    {
        return new ArchiveRestoreResponse([
            'action' => 'restore',
        ]);
    }

    /* ===================================================
       CUSTOM FIELDS
    =================================================== */

    private function getCustomFields($obj = null)
    {
        request()->merge([
            'customfields_type' => 'orders',
            'filter_show_standard_form_status' => 'enabled',
            'filter_field_status' => 'enabled',
        ]);

        return $this->customrepo->search();
    }

    /* ===================================================
       PAGE SETTINGS
    =================================================== */

    private function pageSettings()
    {
        return [
            'crumbs' => [__('lang.orders')],
            'page'   => 'orders',
            'meta_title' => __('lang.orders'),
            'heading'    => __('lang.orders'),
            'load_more_button_route' => 'orders',
            'visibility' => [
                'list_page_actions_search' => true,
                'list_page_actions_add_button' => true,
                'list_page_actions_filter_button' => true,
                'list_page_actions_exporting' => true,
                'archived_orders_toggle_button' => true,
                'stats_toggle_button' => true,
            ],
        ];
    }
}
