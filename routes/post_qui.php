<?php

Route::group(['as' => 'post.qui.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("qui/","index","qui/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("qui","single","qui/{postSlug}"), 'PostController@single')->name('single');
});