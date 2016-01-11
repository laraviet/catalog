<?php

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('products/dashboard', 'Admin\ProductController@dashboard');
    Route::group(['middleware' => 'manage_categories'], function () {
        Route::resource('categories','Admin\CategoryController');
    });
    Route::group(['middleware' => 'manage_products'], function () {
        Route::resource('products','Admin\ProductController');
    });
});