<?php

Route::group(['as' => 'post.est_ut.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("est_ut/","index","est_ut/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("est_ut","single","est_ut/{postSlug}"), 'PostController@single')->name('single');
});