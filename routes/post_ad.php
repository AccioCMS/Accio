<?php

Route::group(['as' => 'post.ad.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("ad/","index","ad/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("ad","single","ad/{postSlug}"), 'PostController@single')->name('single');
});