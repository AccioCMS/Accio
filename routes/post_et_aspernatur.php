<?php

Route::group(['as' => 'post.et_aspernatur.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("et_aspernatur/","index","et_aspernatur/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("et_aspernatur","single","et_aspernatur/{postSlug}"), 'PostController@single')->name('single');
});