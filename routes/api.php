<?php

Route::prefix('customers')->group(function (): void {
    Route::get('/', 'CustomerController@index');
    Route::post('/', 'CustomerController@store');
    Route::get('/{id}', 'CustomerController@show');
    Route::put('/{id}', 'CustomerController@update');
    Route::delete('/{id}', 'CustomerController@delete');
});

Route::prefix('orders')->group(function (): void {
    Route::get('/', 'OrderController@index');
    Route::post('/', 'OrderController@store');
    Route::get('/{id}', 'OrderController@show');
    Route::put('/{id}', 'OrderController@update');
    Route::delete('/{id}', 'OrderController@delete');
});

Route::prefix('statistics')->group(function (): void {
    Route::get('/customers-gained', 'StatisticsController@customersGained');
    Route::get('/revenue-generated', 'StatisticsController@revenueGenerated');
    Route::get('/orders-received', 'StatisticsController@ordersReceived');
    Route::get('/orders-rejected', 'StatisticsController@ordersRejected');
    Route::get('/revenue-comparison', 'StatisticsController@revenueComparison');
    Route::get('/orders-delivered', 'StatisticsController@ordersDelivered');
});
