<?php

Route::group(['prefix' => 'admin'], function () {
    Route::resource("categories","Admin\CategoryController");
    Route::resource("products","Admin\ProductController");
    Route::resource("roles","Admin\RoleController");
});

