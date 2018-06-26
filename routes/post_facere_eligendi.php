<?php

Route::group(['as' => 'post.facere_eligendi.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("facere_eligendi/","index","facere_eligendi/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("facere_eligendi","single","facere_eligendi/{postSlug}"), 'PostController@single')->name('single');
});