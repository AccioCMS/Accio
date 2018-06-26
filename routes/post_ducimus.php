<?php

Route::group(['as' => 'post.ducimus.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("ducimus/","index","ducimus/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("ducimus","single","ducimus/{postSlug}"), 'PostController@single')->name('single');
});