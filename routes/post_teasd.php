<?php

Route::group(['as' => 'post.teasd.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("teasd/","index","teasd/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("teasd","single","teasd/{postSlug}"), 'PostController@single')->name('single');
});