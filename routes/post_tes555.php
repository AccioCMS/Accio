<?php

Route::group(['as' => 'post.tes555.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("tes555/","index","tes555/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("tes555","single","tes555/{postSlug}"), 'PostController@single')->name('single');
});