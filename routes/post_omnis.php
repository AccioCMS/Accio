<?php

Route::group(['as' => 'post.omnis.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("omnis/","index","omnis/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("omnis","single","omnis/{postSlug}"), 'PostController@single')->name('single');
});