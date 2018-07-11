<?php

Route::group(['as' => 'post.ea.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("ea/","index","ea/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("ea","single","ea/{postSlug}"), 'PostController@single')->name('single');
});