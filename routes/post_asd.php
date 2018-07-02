<?php

Route::group(['as' => 'post.asd.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("asd/","index","asd/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("asd","single","asd/{postSlug}"), 'PostController@single')->name('single');
});