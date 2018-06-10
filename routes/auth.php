<?php


/**
 * Auth routes
 * Only define Auth routes if Auth controllers exists
 */
if(authControllerExist()) {
    Route::group(['as' => 'auth.', 'middleware' => ['session','translate'], 'namespace' => \App\Models\Theme::controllersNameSpace()], function () {
        // Authentication Routes...
        Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
        Route::post('login', 'Auth\LoginController@login')->name('login.post');

        // Logout Routes
        Route::get('logout', 'Auth\LoginController@logout')->name('logout');

        // Registration Routes...
        Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
        Route::post('register', 'Auth\RegisterController@register')->name('register.post');;

        // Password Forgot Routes...
        Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('forgot');
        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('forgot.post');

        // Password Reset Routes
        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('reset');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('reset.post');
    });
}