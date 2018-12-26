<?php

/**
 * User routes
 */

Route::group(['as' => 'search.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {
    /**
     * Search Results
     */
    Route::get(permalink("search","results"), 'SearchController@index')->name('results');
    Route::post(permalink("search","results.post"), 'SearchController@index')->name('results.post');
});

