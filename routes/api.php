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

