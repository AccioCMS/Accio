<?php

Route::group(['as' => 'post.qui_explicabo.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("qui_explicabo/","index","qui_explicabo/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("qui_explicabo","single","qui_explicabo/{postSlug}"), 'PostController@single')->name('single');
});