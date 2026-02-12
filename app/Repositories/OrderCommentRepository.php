<?php

namespace App\Repositories;

use App\Models\OrderComment;

class OrderCommentRepository
{
    protected $model;

    public function __construct(OrderComment $model)
    {
        $this->model = $model;
    }

    public function create($order_id)
    {
        $comment = new $this->model;

        $comment->order_id = $order_id;
        $comment->user_id  = auth()->id();
        $comment->comment  = request('comment');

        return $comment->save() ? $comment->id : false;
    }

    public function getByOrder($order_id)
    {
        return $this->model
            ->with('user')
            ->where('order_id', $order_id)
            ->orderBy('id', 'asc')
            ->get();
    }
}
