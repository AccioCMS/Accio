<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Accio\App\Http\Controllers\Api'], function(){
    Route::get('api/posts/related/{postId}', 'Post@related');
});

Route::group(['prefix' => 'auth', 'namespace' => 'Accio\Auth\Controllers'], function () {
    Route::post('login', 'BaseAuthController@login');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'BaseAuthController@logout');
        Route::get('user', 'BaseAuthController@user');
    });
});

