<?php

Route::group(['as' => 'post.quia_nihil.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("quia_nihil/","index","quia_nihil/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("quia_nihil","single","quia_nihil/{postSlug}"), 'PostController@single')->name('single');
});