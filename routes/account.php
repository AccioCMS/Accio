<?php

/**
 * Account routes
 */

Route::group(['as' => 'account.', 'middleware' => ['translate'], 'namespace' => themeNamespace()], function () {
    // Dashboard
    Route::get('account', 'AccountController@dashboard')->name('dashboard');

    //Profile
    Route::get('account/profile', 'AccountController@profile')->name('profile');
});

