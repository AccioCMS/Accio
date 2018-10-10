<?php

Route::group(['as' => 'post.jasdasd.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("jasdasd/","index","jasdasd/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("jasdasd","single","jasdasd/{postSlug}"), 'PostController@single')->name('single');
});