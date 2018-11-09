<?php

Route::group(['as' => 'post.resorts.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("resorts/","index","resorts/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("resorts","single","resorts/{postSlug}"), 'PostController@single')->name('single');
});