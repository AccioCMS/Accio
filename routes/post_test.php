<?php

Route::group(['as' => 'post.test.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get("test/", 'PostController@index')->name('index');

    // Single
    Route::get("test/{postSlug}", 'PostController@single')->name('single');
});