<?php

Route::group(['as' => 'post.architecto_omnis.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("architecto_omnis/","index","architecto_omnis/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("architecto_omnis","single","architecto_omnis/{postSlug}"), 'PostController@single')->name('single');
});