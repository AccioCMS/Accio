<?php

Route::group(['as' => 'post.et-sit.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("et-sit/","index","et-sit/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("et-sit","single","et-sit/{postSlug}"), 'PostController@single')->name('single');
});