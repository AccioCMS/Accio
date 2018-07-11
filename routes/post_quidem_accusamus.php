<?php

Route::group(['as' => 'post.quidem_accusamus.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("quidem_accusamus/","index","quidem_accusamus/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("quidem_accusamus","single","quidem_accusamus/{postSlug}"), 'PostController@single')->name('single');
});