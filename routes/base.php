<?php

/**
 * Base routes
 */

Route::group(['as' => 'base.', 'middleware' => ['translate'], 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {
    /**
     * Search Page
     */
    Route::get(permalink("base","homepage"), 'PagesController@homepage')->name('index');
});