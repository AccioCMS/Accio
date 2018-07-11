<?php

Route::group(['as' => 'post.organizationsaa.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("organizationsaa/","index","organizationsaa/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("organizationsaa","single","organizationsaa/{postSlug}"), 'PostController@single')->name('single');
});