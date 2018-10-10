<?php

Route::group(['as' => 'post.jojojoojoj.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("jojojoojoj/","index","jojojoojoj/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("jojojoojoj","single","jojojoojoj/{postSlug}"), 'PostController@single')->name('single');
});