<?php

Route::group(['as' => 'post.reprehenderit_sint.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("reprehenderit_sint/","index","reprehenderit_sint/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("reprehenderit_sint","single","reprehenderit_sint/{postSlug}"), 'PostController@single')->name('single');
});