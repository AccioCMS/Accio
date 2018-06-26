<?php

Route::group(['as' => 'post.veritatis_non.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("veritatis_non/","index","veritatis_non/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("veritatis_non","single","veritatis_non/{postSlug}"), 'PostController@single')->name('single');
});