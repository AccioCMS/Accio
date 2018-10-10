<?php

Route::group(['as' => 'post.jojojojo.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("jojojojo/","index","jojojojo/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("jojojojo","single","jojojojo/{postSlug}"), 'PostController@single')->name('single');
});