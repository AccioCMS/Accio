<?php

Route::group(['as' => 'post.nuk-e-di-mir-a-jam-i-sak.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("nuk-e-di-mir-a-jam-i-sak/","index","nuk-e-di-mir-a-jam-i-sak/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("nuk-e-di-mir-a-jam-i-sak","single","nuk-e-di-mir-a-jam-i-sak/{postSlug}"), 'PostController@single')->name('single');
});