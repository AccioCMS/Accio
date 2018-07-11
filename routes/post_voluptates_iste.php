<?php

Route::group(['as' => 'post.voluptates_iste.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("voluptates_iste/","index","voluptates_iste/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("voluptates_iste","single","voluptates_iste/{postSlug}"), 'PostController@single')->name('single');
});