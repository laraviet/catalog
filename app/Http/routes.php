<?php

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::resource('categories','Admin\CategoryController');
    Route::get('products/dashboard', 'Admin\ProductController@dashboard');
    Route::resource('products','Admin\ProductController');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', ['as' => 'top', 'uses' => 'FrontendController@index']);
    Route::get('category/{category_id}', ['as' => 'category', 'uses' => 'FrontendController@category']);
    Route::get('product/{product_id}', ['as' => 'show', 'uses' => 'FrontendController@show']);
});