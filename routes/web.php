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
Route::get('/settings', 'DashboardController@settings');

Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::resource('/mails','MailsController');
Route::get('/composemail', 'MailsController@create');
Route::post('/composemail', 'MailsController@postMail');
Route::get('/composemessage', 'MailsController@create');
Route::post('/composemessage', 'MailsController@postMailNoAttach');