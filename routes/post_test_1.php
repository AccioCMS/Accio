<?php

Route::group(['as' => 'post.test_1.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("test_1/","index","test_1/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("test_1","single","test_1/{postSlug}"), 'PostController@single')->name('single');
});