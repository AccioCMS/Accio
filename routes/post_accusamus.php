<?php

Route::group(['as' => 'post.accusamus.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("accusamus/","index","accusamus/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("accusamus","single","accusamus/{postSlug}"), 'PostController@single')->name('single');
});