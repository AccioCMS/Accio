<?php

Route::group(['as' => 'post.recusandae_quos.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("recusandae_quos/","index","recusandae_quos/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("recusandae_quos","single","recusandae_quos/{postSlug}"), 'PostController@single')->name('single');
});