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

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
Route::get('/inbox', 'DashboardController@inbox');
Route::get('/settings', 'DashboardController@setup');
Route::post('/settings', 'DashboardController@settings');

Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::resource('/mails','MailsController');
Route::get('/composemail', 'MailsController@create');
Route::post('/composemail', 'MailsController@postMail');

Route::get('/composemessage', 'MailsController@createnoattach');
Route::post('/composemessage', 'MailsController@postMailNoAttach');

Route::get('/file', 'FileController@index')->name('viewFile');
Route::get('/upload', 'FileController@create')->name('formFile');
Route::post('/upload', 'FileController@store')->name('uploadFile');
Route::delete('/file/{id}', 'FileController@destroy')->name('deleteFile');
Route::get('/file/{id}', 'FileController@show')->name('showFile');
Route::get('/file/download/{id}', 'FileController@download')->name('downloadFile');
Route::get('/file/email/{id}', 'FileController@edit')->name('emailFile');
Route::get('/createMail', 'FileController@createMail')->name('createMail');;
Route::get('/file/encrypt/{id}', 'FileController@encrypt')->name('encryptFile');
Route::post('/createMail', 'FileController@sentMail')->name('sentMail');
Route::get('/file/decrypt/{id}', 'FileController@decrypt')->name('decryptFile');

Route::get('/2fa','PasswordSecurityController@show2faForm');
Route::post('/generate2faSecret','PasswordSecurityController@generate2faSecret')->name('generate2faSecret');
Route::post('/2fa','PasswordSecurityController@enable2fa')->name('enable2fa');
Route::post('/disable2fa','PasswordSecurityController@disable2fa')->name('disable2fa');

Route::post('/2faVerify', function () {
    return redirect(URL()->previous());
    })->name('2faVerify')->middleware('2fa');
//Route::get('/encrypt', 'PagesController@main');
//Route::post('/upload', 'PagesController@upload');
//Route::get('/download', 'PagesController@download');
