<?php

Route::group(['as' => 'post.asdasd.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("asdasd/","index","asdasd/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("asdasd","single","asdasd/{postSlug}"), 'PostController@single')->name('single');
});