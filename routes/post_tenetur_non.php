<?php

Route::group(['as' => 'post.tenetur_non.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("tenetur_non/","index","tenetur_non/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("tenetur_non","single","tenetur_non/{postSlug}"), 'PostController@single')->name('single');
});