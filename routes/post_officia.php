<?php

Route::group(['as' => 'post.officia.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("officia/","index","officia/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("officia","single","officia/{postSlug}"), 'PostController@single')->name('single');
});