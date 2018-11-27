<?php

Route::group(['as' => 'post.test-1.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("test-1/","index","test-1/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("test-1","single","test-1/{postSlug}"), 'PostController@single')->name('single');
});