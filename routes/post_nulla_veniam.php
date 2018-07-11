<?php

Route::group(['as' => 'post.nulla_veniam.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("nulla_veniam/","index","nulla_veniam/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("nulla_veniam","single","nulla_veniam/{postSlug}"), 'PostController@single')->name('single');
});