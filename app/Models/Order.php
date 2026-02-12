<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'order_number',
        'client_name',
        'client_id',
        'user_id',
        'shop_id',
        'status_id',
        'operator_result',
        'opened_at',
        'closed_at',
        'source_type',
        'sales_model_id',
        'total_amount',
        'created_at',
        'updated_at',
        'operator_id',
        'first_name',
        'last_name',
        'phone',
        'order_updated',
        'order_created',
    ];

    protected $casts = [
        'total_amount' => 'float',
        'opened_at' => 'datetime',
        'closed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'order_created' => 'datetime',
        'order_updated' => 'datetime',
    ];

    public function comments()
{
    return $this->hasMany(\App\Models\OrderComment::class, 'order_id')
        ->orderBy('id', 'asc');
}

}
