<?php

Route::group(['as' => 'post.eos.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("eos/","index","eos/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("eos","single","eos/{postSlug}"), 'PostController@single')->name('single');
});