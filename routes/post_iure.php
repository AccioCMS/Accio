<?php

Route::group(['as' => 'post.iure.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("iure/","index","iure/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("iure","single","iure/{postSlug}"), 'PostController@single')->name('single');
});