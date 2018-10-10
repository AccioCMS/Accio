<?php

Route::group(['as' => 'post.312teas55.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("312teas55/","index","312teas55/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("312teas55","single","312teas55/{postSlug}"), 'PostController@single')->name('single');
});