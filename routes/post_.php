<?php

Route::group(['as' => 'post..', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("/","index","/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("","single","/{postSlug}"), 'PostController@single')->name('single');
});