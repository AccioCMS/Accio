<?php

Route::group(['as' => 'post.pages.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Single
    Route::get("pages/{postSlug}", 'PagesController@single')->name('single');
});