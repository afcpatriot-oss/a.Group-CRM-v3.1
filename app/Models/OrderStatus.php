<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table = 'order_statuses';

    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * Relationship:
     *  - One OrderStatus has many Orders
     *  - Order belongs to one OrderStatus
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Order', 'order_status', 'id');
    }
}
