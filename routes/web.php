<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('wel');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('super_Admin', 'Provider\SuperAdminController');
Route::get('super_Admin/{id}/delete', 'Provider\SuperAdminController@destroy');

Route::resource('provider', 'Provider\providerController');
Route::get('provider/{id}/delete', 'Provider\providerController@destroy');
