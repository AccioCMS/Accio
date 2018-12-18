<?php

/**
 * Base routes
 */


Route::group(['as' => 'base.', 'middleware' => ['translate'], 'namespace' => themeNamespace()], function () {
    /**
     * Search Page
     */
    Route::get(permalink("base","homepage"), 'PagesController@homepage')->name('homepage');
});