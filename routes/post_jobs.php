<?php

Route::group(['as' => 'post.jobs.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get("jobs", 'PostController@index')->name('index');

    // Single
    Route::get("jobs/{postSlug}", 'PostController@single')->name('single');
});