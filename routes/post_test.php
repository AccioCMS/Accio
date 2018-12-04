<?php

Route::group(['as' => 'post.test.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("test/","index","test/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("test","single","test/{postSlug}"), 'PostController@single')->name('single');
});