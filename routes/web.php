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

Route::get('/', function(){ return redirect('/album'); });
Route::delete('/image/{id}',array('uses' => 'ImageController@destroy'));
Route::resource('/album', 'AlbumController');
Route::resource('album/{id}', 'AlbumController@show');
Route::resource('image/{id}/', 'ImageController');
