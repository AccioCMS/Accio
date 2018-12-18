<?php

/**
 * User routes
 */

Route::group(['as' => 'search.', 'middleware' => 'translate', 'namespace' => themeNamespace()], function () {
    /**
     * Search Results
     */
    Route::get(permalink("search","results"), 'SearchController@index')->name('results');
    Route::post(permalink("search","results.post"), 'SearchController@index')->name('results.post');
});

