<?php

Route::group(['as' => 'post.sapiente_eaque.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("sapiente_eaque/","index","sapiente_eaque/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("sapiente_eaque","single","sapiente_eaque/{postSlug}"), 'PostController@single')->name('single');
});