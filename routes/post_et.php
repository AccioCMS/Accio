<?php

Route::group(['as' => 'post.et.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("et/","index","et/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("et","single","et/{postSlug}"), 'PostController@single')->name('single');
});