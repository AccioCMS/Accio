<?php

Route::group(['as' => 'post.articles.', 'middleware' => 'translate', 'namespace' => themeNamespace()], function () {

    // Index
    Route::get(permalink("post_articles","index"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("post_articles","single"), 'PostController@single')->name('single');
});