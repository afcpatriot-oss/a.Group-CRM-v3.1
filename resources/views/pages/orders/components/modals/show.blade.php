<div class="card-body">

    <div class="row">
        <div class="col-md-12">
            <h5>Order #{{ $order->order_id }}</h5>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <strong>Title:</strong>
            <p>{{ $order->order_title }}</p>
        </div>

        <div class="col-md-6">
            <strong>Status:</strong>
            <p>{{ $order->order_status }}</p>
        </div>
    </div>
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Http\Responses\Orders\IndexResponse;
use App\Http\Responses\Orders\ShowResponse;
use App\Http\Responses\Orders\CreateResponse;
use App\Http\Responses\Orders\StoreResponse;
use App\Http\Responses\Orders\UpdateResponse;

class Orders extends Controller
{
    protected $orderrepo;

    public function __construct(OrderRepository $orderrepo)
    {
        parent::__construct();

        $this->middleware('auth');

        $this->orderrepo = $orderrepo;
    }

    /**
     * Orders index
     */
    public function index()
    {
        $orders = $this->orderrepo->search();

        $payload = [
            'page' => [
                'page'    => 'orders',
                'heading' => cleanLang(__('lang.orders')),
            ],
            'orders' => $orders,
        ];

        return new IndexResponse($payload);
    }

    /**
     * Show single order (cardModal)
     */
    public function show($id)
    {
        $order = $this->orderrepo->find($id);

        if (!$order) {
            abort(404);
        }

        $payload = [
            'order' => $order,
        ];

        return new ShowResponse($payload);
    }

    /**
     * Create modal
     */
    public function create()
    {
        return new CreateResponse([]);
    }

    /**
     * Store new order
     */
    public function store()
    {
        $id = $this->orderrepo->create();

        if (!$id) {
            abort(409);
        }

        $order = $this->orderrepo->find($id);

        return new StoreResponse([
            'order' => $order,
        ]);
    }

    /**
     * Update order
     */
    public function update($id)
    {
        $updated = $this->orderrepo->update($id);

        if (!$updated) {
            abort(409);
        }

        $order = $this->orderrepo->find($id);

        return new UpdateResponse([
            'order' => $order,
        ]);
    }
}

</div>

