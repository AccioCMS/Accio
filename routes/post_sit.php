<?php

Route::group(['as' => 'post.sit.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("sit/","index","sit/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("sit","single","sit/{postSlug}"), 'PostController@single')->name('single');
});