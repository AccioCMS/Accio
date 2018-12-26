<?php

/**
 * User routes
 */

Route::group(['as' => 'user.', 'middleware' => 'translate','namespace' => \App\Models\Theme::controllersNameSpace()], function () {
    /**
     * GET
     */
    Route::get(permalink("user","single"), 'UserController@single')->name('single');
    Route::get(permalink("user","posts"), 'UserController@posts')->name('posts');
});

