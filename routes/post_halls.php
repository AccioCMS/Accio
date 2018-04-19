<?php

Route::group(['as' => 'post.halls.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get("halls/", 'PostController@index')->name('index');

    // Single
    Route::get("halls/{postSlug}", 'PostController@single')->name('single');
});