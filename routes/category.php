<?php


/**
 * Category routes
 */
Route::group(['as' => 'category.','middleware' =>[ 'translate'],'namespace' => themeNamespace()], function () {
    /**
     * GET
     */
    Route::get(permalink("category","posts"), 'CategoryController@posts')->name('posts');
    Route::get(permalink("category","single"), 'CategoryController@single')->name('single');
});

