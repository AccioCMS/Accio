<?php

Route::group(['as' => 'post.vitae_quasi.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("vitae_quasi/","index","vitae_quasi/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("vitae_quasi","single","vitae_quasi/{postSlug}"), 'PostController@single')->name('single');
});