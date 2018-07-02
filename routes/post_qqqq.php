<?php

Route::group(['as' => 'post.qqqq.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("qqqq/","index","qqqq/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("qqqq","single","qqqq/{postSlug}"), 'PostController@single')->name('single');
});