<?php

/**
 * Tags routes
 */

Route::group(['as' => 'tag.', 'middleware' => 'translate', 'namespace' => themeNamespace()], function () {
    Route::get(permalink("tag","single"), 'TagController@single')->name('single');
});

