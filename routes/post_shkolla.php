<?php

Route::group(['as' => 'post.shkolla.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("shkolla/","index","shkolla/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("shkolla","single","shkolla/{postSlug}"), 'PostController@single')->name('single');
});