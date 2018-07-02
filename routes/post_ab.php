<?php

Route::group(['as' => 'post.ab.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("ab/","index","ab/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("ab","single","ab/{postSlug}"), 'PostController@single')->name('single');
});