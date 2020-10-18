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

//Begin Hiden Routs-------------------------------->
Route::resource('super_Admin', 'Provider\SuperAdminController');
Route::get('super_Admin/{id}/delete', 'Provider\SuperAdminController@destroy');
//ads Page Routs
Route::resource('ads', 'Provider\AdsController');
Route::get('ads/{id}/delete', 'Provider\AdsController@destroy');

//end Hidden Routs --------------------------------->
Route::get('ad_cost', 'Provider\SuperAdminController@show_ad_cost');
Route::post('ad_cost/update/{id}', 'Provider\SuperAdminController@update_ad_cost');



Route::resource('provider', 'Provider\providerController');
Route::get('provider/{id}/delete', 'Provider\providerController@destroy');
//ads Page Routs
Route::resource('ads', 'Provider\AdsController');
Route::get('ads/{id}/delete', 'Provider\AdsController@destroy');
Route::get('ads/{id}/images', 'Provider\AdsController@show');
Route::post('ads_images/{id}', 'Provider\AdsController@storeAdImage');
Route::post('destroy_ads_images', 'Provider\AdsController@destroyAdImages');

Route::get('change_status_Accept/{id}/status', 'Provider\AdsController@accept_status');
Route::get('change_status_Reject/{id}/status', 'Provider\AdsController@reject_status');

Route::resource('ads_admin', 'Provider\adminAdsController');

Route::get('ads_admins/{status}', 'Provider\adminAdsController@getAdsByStatus');
Route::get('BlockProvider/{provider_id}', 'Provider\adminAdsController@block_user');

Route::resource('category', 'Provider\categoryController');
Route::get('category/{id}/delete', 'Provider\categoryController@destroy');




