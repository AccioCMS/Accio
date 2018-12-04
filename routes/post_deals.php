<?php

Route::group(['as' => 'post.deals.', 'middleware' => 'translate', 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {

    // Index
    Route::get(permalink("deals/","index","deals/"), 'PostController@index')->name('index');

    // Single
    Route::get(permalink("deals","single","deals/{postSlug}"), 'PostController@singleDeal')->name('single');

    Route::get("weeklyDeals", 'PostController@weeklyDeals')->name('weeklyDeals');
});