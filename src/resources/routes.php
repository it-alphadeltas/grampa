<?php

Route::group(['middleware' => ['web']], function () {
    /*
     * Render admin login page.
     */
    Route::get(
        '/login-admin',
        '\AlphaDeltas\Grampa\Controllers\AdminAuthController@index'
    )
    ->middleware('auth.grampa')
    ->name('login-admin');

    /*
     * Authenticate and set shop as grandfathered in callback.
     */
    Route::match(
        ['get', 'post'],
        '/authenticate-admin',
        '\AlphaDeltas\Grampa\Controllers\AdminAuthController@authenticate'
    )
    ->name('authenticate-admin');
});


