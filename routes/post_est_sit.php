<?php

Route::group(['as' => 'post.est_sit.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("est_sit/","index","est_sit/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("est_sit","single","est_sit/{postSlug}"), 'PostController@single')->name('single');
});