<?php

use Modules\Settings\Http\Controllers\OrderStatusGroupController;

Route::get(
    'settings/order-status-groups',
    [OrderStatusGroupController::class, 'index']
);

Route::post(
    'settings/order-status-groups/store',
    [OrderStatusGroupController::class, 'store']
);

Route::post(
    'settings/order-status-groups/update/{id}',
    [OrderStatusGroupController::class, 'update']
);

Route::get(
    'settings/order-status-groups/delete/{id}',
    [OrderStatusGroupController::class, 'delete']
);
