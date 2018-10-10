<?php

Route::group(['as' => 'post.222asd.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("222asd/","index","222asd/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("222asd","single","222asd/{postSlug}"), 'PostController@single')->name('single');
});