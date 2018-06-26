<?php

Route::group(['as' => 'post.illo.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("illo/","index","illo/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("illo","single","illo/{postSlug}"), 'PostController@single')->name('single');
});