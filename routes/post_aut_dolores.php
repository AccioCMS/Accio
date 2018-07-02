<?php

Route::group(['as' => 'post.aut_dolores.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("aut_dolores/","index","aut_dolores/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("aut_dolores","single","aut_dolores/{postSlug}"), 'PostController@single')->name('single');
});