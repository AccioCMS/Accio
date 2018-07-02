<?php

Route::group(['as' => 'post.quia_quia.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("quia_quia/","index","quia_quia/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("quia_quia","single","quia_quia/{postSlug}"), 'PostController@single')->name('single');
});