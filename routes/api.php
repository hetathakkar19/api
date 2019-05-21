<?php

//authentication
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::group([
        'middleware' => 'auth:api'
    ], function (
    ) {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});
//products and reviews
Route::apiResource('/products', 'ProductController');
Route::group(['prefix' => 'products'], function () {
    Route::apiResource('/{product}/reviews', 'ReviewController');


});