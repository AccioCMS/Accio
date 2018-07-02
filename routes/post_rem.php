<?php

Route::group(['as' => 'post.rem.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("rem/","index","rem/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("rem","single","rem/{postSlug}"), 'PostController@single')->name('single');
});