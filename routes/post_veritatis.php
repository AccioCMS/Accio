<?php

Route::group(['as' => 'post.veritatis.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("veritatis/","index","veritatis/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("veritatis","single","veritatis/{postSlug}"), 'PostController@single')->name('single');
});