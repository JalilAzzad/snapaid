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

// Track Controller
Route::get('/track/postback/{credit_hash}', 'TrackController@postback');
Route::get('/track/{cause_id}/{offer_id}/', 'TrackController@track')
    ->where(['cause_id' => '[0-9]+', 'offer_id' => '[0-9]+', 'user_id' => '[0-9]+']);
Route::any('/credit_hash/{report_id}/', 'TrackController@creditHash')
    ->where(['report_id' => '[0-9]+']);

Route::get('/', 'HomeController@index', ['middleware' => ['guest']])->name('index');
Route::get('/home', 'HomeController@home')->middleware('auth', 'auth.emailconfirm');
Route::get('/faq', 'HomeController@faq')->name('faq');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::any('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('/join/causes', 'Auth\RegisterController@showRegisterCausesForm')->name('register');
Route::post('/join/causes', 'Auth\RegisterController@registerCauses');
Route::get('/join/accountinfo', 'Auth\RegisterController@showRegistrationForm')->name('register.account');
Route::post('/join/accountinfo', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/emailconfirm/{id}/{email_confirm_code}', 'Auth\RegisterController@confirmEmail');
Route::get('/emailconfirm/', 'Auth\RegisterController@confirmEmailError');


Route::get('/causes', 'CausesController@index')->name('causes');
Route::get('/causes/{slug}', 'CausesController@show')->name('causes.show');
Route::get('/causes/{slug}/status', 'CausesController@checkStatus')->name('causes.status');
Route::get('/causes/{slug}/wall', 'CausesController@showWall')->name('causes.show.wall');
Route::get('/profile/{id}', 'UserController@show')->name('profile');

Route::get('/causes/{slug}/donate', 'DonateController@getDonatePage')->name('causes.donate');

Route::get('admin', function (){
    return redirect('admin/causes');
});
Route::resource('admin/causes', 'Admin\CausesController');

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
// Ignores notices and reports all other kinds... and warnings
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}