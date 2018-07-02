<?php

Route::group(['as' => 'post.non.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("non/","index","non/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("non","single","non/{postSlug}"), 'PostController@single')->name('single');
});