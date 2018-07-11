<?php

Route::group(['as' => 'post.dolorem.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("dolorem/","index","dolorem/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("dolorem","single","dolorem/{postSlug}"), 'PostController@single')->name('single');
});