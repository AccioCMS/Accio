<?php

Route::group(['as' => 'post.nuk-din-mixha-sen.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("nuk-din-mixha-sen/","index","nuk-din-mixha-sen/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("nuk-din-mixha-sen","single","nuk-din-mixha-sen/{postSlug}"), 'PostController@single')->name('single');
});