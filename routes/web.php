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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/distances', 'DistanceController@index')->name('distances');

Route::get('/calculate', 'DistanceController@calculate')->name('calculate');

Route::post('/edit', 'HomeController@edit')->name('edit')->middleware('web');

Route::post('/', 'HomeController@add')->name('add');