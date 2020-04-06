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
use App\Mail\PharmacyAcceptanceMail;
use App\Mail\PharmacistAcceptanceMail;
//Route::get('/', function () {
//    return view('welcome');
//});

//Auth::routes();

// Login Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/registration', 'RegistrationController@showRegistrationForm')->name('registration');
Route::post('/registration', 'RegistrationController@processRegistration');

Route::get('/downloadSupportingPDF', 'RegistrationController@downloadPdf');

Route::get('/', 'HomeController@index')->name('home');


Route::get('importExportView', 'PharmacyController@importExportView');
Route::post('import', 'PharmacyController@import')->name('import');

Route::get('importExportView', 'PharmacistController@importExportView');
Route::post('import', 'PharmacistController@import')->name('import');


Route::get('/pharmacy-acceptance/{id}', 'PharmacyController@acceptanceForm');
Route::get('/pharmacist-acceptance/{id}', 'PharmacistController@acceptanceForm');

Route::post('/pharmacy-acceptance/{id}', 'PharmacyController@acceptanceFormCompletion');
Route::post('/pharmacist-acceptance/{id}', 'PharmacistController@acceptanceFormCompletion');



Route::get('/pharmacy-acceptance', function () {
    return new PharmacyAcceptanceMail();
});


Route::get('/pharmacist-acceptance', function () {
    return new PharmacistAcceptanceMail();
});