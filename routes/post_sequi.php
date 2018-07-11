<?php

Route::group(['as' => 'post.sequi.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("sequi/","index","sequi/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("sequi","single","sequi/{postSlug}"), 'PostController@single')->name('single');
});