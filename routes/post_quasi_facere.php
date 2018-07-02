<?php

Route::group(['as' => 'post.quasi_facere.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("quasi_facere/","index","quasi_facere/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("quasi_facere","single","quasi_facere/{postSlug}"), 'PostController@single')->name('single');
});