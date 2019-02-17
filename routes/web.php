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
Route::get('/login','Auth\LoginController@login');
Route::post('/login','Auth\LoginController@authenticate')->name('login');
Route::get('/logout','Auth\LoginController@logout')->name('logout');
Route::get('/','Adverts\AdvertsController@getAllAdverts');
Route::get('/edit','Adverts\AdvertsController@createAdvert');
Route::get('/advert/{id}','Adverts\AdvertsController@showAdvert');
Route::post('/paginate','Adverts\AdvertsController@pagginateAdverts');
Route::get('/edit/{id}','Adverts\AdvertsController@editAdvert');
Route::post('/save_advert','Adverts\AdvertsController@saveAdvert');
Route::post('/save_after_edit','Adverts\AdvertsController@saveAfterEditAdvert');
Route::post('/delete_advert','Adverts\AdvertsController@deleteAdvert');
//Auth::routes();

