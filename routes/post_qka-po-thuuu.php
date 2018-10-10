<?php

Route::group(['as' => 'post.qka-po-thuuu.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("qka-po-thuuu/","index","qka-po-thuuu/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("qka-po-thuuu","single","qka-po-thuuu/{postSlug}"), 'PostController@single')->name('single');
});