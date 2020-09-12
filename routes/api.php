<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', 'API\AuthController@login');
Route::post('logout','API\AuthController@logout');

Route::post('register','API\registerApiController@store');
Route::post('update_profile','API\registerApiController@update_profile');
Route::post('userProfile','API\registerApiController@user_Profile');


Route::post('all_ads','API\AdsApiController@all_ads');
Route::post('store_ad','API\AdsApiController@store_ad');
Route::post('uodate_ad','API\AdsApiController@uodate_ad');
Route::post('delete_ad','API\AdsApiController@delete_ad');

Route::post('ads_WithCat','API\AdsApiController@ads_WithCat');
Route::post('ad_with_id','API\AdsApiController@ad_with_id');
Route::post('change_status','API\AdsApiController@change_status');


Route::post('all_ad_images','API\AdsImagesApiController@all_ad_images');
Route::post('store_ad_images','API\AdsImagesApiController@store_ad_images');
Route::post('delete_ad_images','API\AdsImagesApiController@delete_ad_images');

Route::post('categories','API\CategoryApiController@index');

Route::post('settings','API\settingsApiController@index');
Route::post('update_settings','API\settingsApiController@update');





