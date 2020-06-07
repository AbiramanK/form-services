<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'auth'], function () {
    Route::post('signin', ['as' => 'login', 'uses' => 'AuthController@signin']);
    Route::post('signup', 'AuthController@signup');
});

Route::group([
    'middleware' => 'auth:api'
], function () {
    Route::post('logout', 'AuthController@logout');
    Route::post('site/info', 'SiteController@store');
    Route::post('ethics/info', 'SiteController@store_ethics');
    Route::get('get-data', 'SiteController@getData');
    Route::put('update-data', 'SiteController@updateData');
}); 