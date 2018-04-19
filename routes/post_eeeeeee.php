<?php

Route::group(['as' => 'post.eeeeeee.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("eeeeeee/","index","eeeeeee/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("eeeeeee","single","eeeeeee/{postSlug}"), 'PostController@single')->name('single');
});