<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/login', 'Auth\authController@login')->name('login');
Route::post('/logout', 'Auth\authController@logout')->name('logout');
Route::post('/register', 'Auth\authController@register')->name('register');
Route::post('/verifyaccount', 'Auth\authController@verifyAccount')->name('verifyaccount');
Route::post('/verifyRestingPassword', 'Auth\authController@verifyRestingPassword')->name('verifyRestingPassword');
Route::post('/sendVerificationCodeRegistering', 'Auth\authController@sendVerificationCodeRegistering')->name('sendVerificationCodeRegistering');
Route::post('/sendVerificationCodeResetingPasssword', 'Auth\authController@sendVerificationCodeResetingPasssword')->name('sendVerificationCodeResetingPasssword');
Route::post('/resetPassword', 'Auth\authController@resetPassword')->name('resetPassword');
Route::post('/changePassword', 'Auth\authController@changePassword')->name('changePassword');
