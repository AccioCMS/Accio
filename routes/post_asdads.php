<?php

Route::group(['as' => 'post.asdads.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get("asdads/", 'PostController@index')->name('index');

    // Single
    Route::get("asdads/{postSlug}", 'PostController@single')->name('single');
});