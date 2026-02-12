<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Support\Facades\Schema;

class OrderRepository
{
    protected $orders;

    public function __construct(Order $orders)
    {
        $this->orders = $orders;
    }

    /**
     * Search Orders
     */
    public function search($id = '')
    {
        $orders = $this->orders->newQuery();

        $orders->selectRaw('*');

        // Single record
        if (is_numeric($id)) {
            $orders->where('id', $id);
        }

        // Search filter
        if (request()->filled('search_query')) {
            $orders->where(function ($query) {
                $query->where('order_number', 'LIKE', '%' . request('search_query') . '%')
                      ->orWhere('client_name', 'LIKE', '%' . request('search_query') . '%')
                      ->orWhere('phone', 'LIKE', '%' . request('search_query') . '%');
            });
        }

        // Filter by status
        if (request()->filled('filter_status_id')) {
            $orders->where('status_id', request('filter_status_id'));
        }

        // Sorting
        if (in_array(request('sortorder'), ['asc', 'desc']) && request('orderby') != '') {

            if (Schema::hasColumn('orders', request('orderby'))) {
                $orders->orderBy(request('orderby'), request('sortorder'));
            }

        } else {
            $orders->orderBy('id', 'desc');
        }

        return $orders->paginate(config('system.settings_system_pagination_limits'));
    }

    /**
     * Create Order
     */
    public function create()
    {
        $order = new Order();

        $order->order_number  = request('order_number');
        $order->client_name   = request('client_name');
        $order->phone         = request('phone');
        $order->total_amount  = request('total_amount', 0);
        $order->status_id     = request('status_id', 1);
        $order->order_created = now();

        return $order->save() ? $order->id : false;
    }

    /**
     * Update Order
     */
    public function update($id)
    {
        if (!$order = $this->orders->find($id)) {
            return false;
        }

        $order->client_name  = request('client_name');
        $order->phone        = request('phone');
        $order->total_amount = request('total_amount');
        $order->status_id    = request('status_id');

        return $order->save();
    }

    /**
     * Delete Order
     */
    public function delete($id)
    {
        return $this->orders->where('id', $id)->delete();
    }
}
