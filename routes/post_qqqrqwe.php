<?php

Route::group(['as' => 'post.qqqrqwe.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("qqqrqwe/","index","qqqrqwe/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("qqqrqwe","single","qqqrqwe/{postSlug}"), 'PostController@single')->name('single');
});