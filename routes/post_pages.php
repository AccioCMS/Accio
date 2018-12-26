<?php

Route::group(['as' => 'post.pages.', 'middleware' => 'translate', 'namespace' => themeNamespace()], function () {

    // Single
    Route::get("pages/{postSlug}", 'PagesController@single')->name('single');
});