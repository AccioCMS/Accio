<?php

Route::group(['as' => 'post.nobis_quis.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("nobis_quis/","index","nobis_quis/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("nobis_quis","single","nobis_quis/{postSlug}"), 'PostController@single')->name('single');
});