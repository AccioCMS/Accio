<?php

Route::group(['as' => 'post.aaaa-pijata.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("aaaa-pijata/","index","aaaa-pijata/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("aaaa-pijata","single","aaaa-pijata/{postSlug}"), 'PostController@single')->name('single');
});