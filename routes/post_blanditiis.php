<?php

Route::group(['as' => 'post.blanditiis.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("blanditiis/","index","blanditiis/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("blanditiis","single","blanditiis/{postSlug}"), 'PostController@single')->name('single');
});