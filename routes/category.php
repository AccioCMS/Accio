<?php


/**
 * Category routes
 */

Route::group(['as' => 'category.','middleware' =>[ 'translate'],'namespace' => \App\Models\Theme::controllersNameSpace()], function () {
    /**
     * GET
     */
    Route::get(permalink("category","posts"), 'CategoryController@posts')->name('posts');
    Route::get(permalink("category","single"), 'CategoryController@single')->name('single');
});

