<?php

Route::group(['as' => 'post.maiores_fuga.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("maiores_fuga/","index","maiores_fuga/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("maiores_fuga","single","maiores_fuga/{postSlug}"), 'PostController@single')->name('single');
});