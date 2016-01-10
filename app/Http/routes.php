<?php

Route::group(['prefix' => 'admin'], function () {
    Route::resource('categories','Admin\CategoryController');
    Route::resource('products','Admin\ProductController');
});

Route::get('/', ['as' => 'top', 'uses' => 'FrontendController@index']);
Route::get('category/{category_id}', ['as' => 'category', 'uses' => 'FrontendController@category']);
Route::get('product/{product_id}', ['as' => 'show', 'uses' => 'FrontendController@show']);