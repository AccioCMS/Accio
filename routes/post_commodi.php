<?php

Route::group(['as' => 'post.commodi.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("commodi/","index","commodi/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("commodi","single","commodi/{postSlug}"), 'PostController@single')->name('single');
});