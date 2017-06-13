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
Auth::routes();

Route::resource('profile', 'ProfileController');

Route::resource('research', 'ResearchContoller');

Route::resource('journal', 'JournalController');

Route::post('profile/uploadProfileImage', 'ProfileController@uploadProfileImage');
Route::post('authen', 'Auth\LoginController@authenticate')->name('authen');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

