<?php

Route::auth();
Route::get('/', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {
    Route::controllers([
        'orders' => 'OrdersController',
        'product' => 'ProductController',
    ]);
});
