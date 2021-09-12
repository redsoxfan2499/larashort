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
Route::get('links', 'LinkMappingController@index')->name('links.index');
Route::get('links/{link}', 'LinkMappingController@show')->name('links.show');
Route::get('/','LinkMappingController@create')->name('links.create');
Route::post('/', 'LinkMappingController@store')->name('links.store');
Route::get('/{slug}/{code}', 'LinkMappingController@handleRedirectRequest')->name('handleRedirectRequest');


