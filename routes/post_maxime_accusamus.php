<?php

Route::group(['as' => 'post.maxime_accusamus.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("maxime_accusamus/","index","maxime_accusamus/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("maxime_accusamus","single","maxime_accusamus/{postSlug}"), 'PostController@single')->name('single');
});