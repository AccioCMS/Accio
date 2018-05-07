<?php

Route::group(['as' => 'post.dolores_delectus.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("dolores_delectus/","index","dolores_delectus/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("dolores_delectus","single","dolores_delectus/{postSlug}"), 'PostController@single')->name('single');
});