<?php

Route::group(['as' => 'post.id.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("id/","index","id/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("id","single","id/{postSlug}"), 'PostController@single')->name('single');
});