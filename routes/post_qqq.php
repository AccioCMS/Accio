<?php

Route::group(['as' => 'post.qqq.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("qqq/","index","qqq/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("qqq","single","qqq/{postSlug}"), 'PostController@single')->name('single');
});