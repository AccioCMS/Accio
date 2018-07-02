<?php

Route::group(['as' => 'post.ut.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("ut/","index","ut/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("ut","single","ut/{postSlug}"), 'PostController@single')->name('single');
});