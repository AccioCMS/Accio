<?php

Route::group(['as' => 'post.tempore_eum.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("tempore_eum/","index","tempore_eum/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("tempore_eum","single","tempore_eum/{postSlug}"), 'PostController@single')->name('single');
});