<?php

Route::group(['as' => 'post.voluptatem.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("voluptatem/","index","voluptatem/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("voluptatem","single","voluptatem/{postSlug}"), 'PostController@single')->name('single');
});