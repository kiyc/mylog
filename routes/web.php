<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/new', 'HomeController@index');
    Route::get('/settings', 'HomeController@index');

    Route::prefix('api')->name('api.')->group(function () {
        Route::prefix('user_logs')->name('user_logs.')->group(function () {
            Route::get('/', 'UserLogController@index')->name('index');
            Route::post('/', 'UserLogController@store')->name('store');
        });

        Route::post('upload_icon', 'SettingsController@uploadIcon')->name('upload_icon');

        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/', 'SettingsController@index')->name('index');
            Route::patch('/', 'SettingsController@update')->name('update');
        });
    });
});
