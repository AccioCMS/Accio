<?php

Route::group(['as' => 'post.rerum.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("rerum/","index","rerum/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("rerum","single","rerum/{postSlug}"), 'PostController@single')->name('single');
});