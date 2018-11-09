<?php

Route::group(['as' => 'post.blog.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("blog/","index","blog/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("blog","single","blog/{postSlug}"), 'PostController@single')->name('single');
});