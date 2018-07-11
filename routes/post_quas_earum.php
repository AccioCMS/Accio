<?php

Route::group(['as' => 'post.quas_earum.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("quas_earum/","index","quas_earum/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("quas_earum","single","quas_earum/{postSlug}"), 'PostController@single')->name('single');
});