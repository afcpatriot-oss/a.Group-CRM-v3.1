<?php

/**----------------------------------------------------------------------------------------------------------------
 * [a. Group CRM - CUSTOM ROUTES]
 * Place your custom routes or overides in this file. This file is not updated with CRM updates
 * ---------------------------------------------------------------------------------------------------------------*/

use App\Http\Controllers\Orders;

// Orders
Route::group(['prefix' => 'orders'], function () {

    Route::get('/', [Orders::class, 'index'])
        ->name('orders.index');

    Route::get('/create', [Orders::class, 'create'])
        ->name('orders.create');

    Route::post('/', [Orders::class, 'store'])
        ->name('orders.store');

    Route::get('/{order}', [Orders::class, 'show'])
        ->where('order', '[0-9]+')
        ->name('orders.show');

    Route::put('/{order}', [Orders::class, 'update'])
        ->name('orders.update');
});

