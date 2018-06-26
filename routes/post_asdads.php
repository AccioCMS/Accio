<?php

Route::group(['as' => 'post.asdads.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("asdads/","index","asdads/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("asdads","single","asdads/{postSlug}"), 'PostController@single')->name('single');
});