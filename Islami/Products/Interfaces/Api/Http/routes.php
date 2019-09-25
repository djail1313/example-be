<?php


Route::group(['middleware' => [], 'prefix' => 'v1/products', 'namespace' => 'Islami\Products\Interfaces\Api\Http\Controllers'], function () {
    Route::post('/','ProductController@create');
    Route::post('/{id}/stock/reduce','ProductController@reduceStock');
});
