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
//Route::resource('album', 'AlbumController');
Route::resource('image', 'ImageController');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/api', 'Api\AlbumApiController@index');


Route::patch('/preferences/{id}',[
    'as' => 'user.preferences.update',
    'uses' => 'UserController@update'
]);
Route::get('/album',[
    'as' => 'album.index',
    'uses' => 'AlbumController@index'
], function () {})->middleware('permission:show');

Route::get('/album/{id}/edit',[
    'as' => 'album.edit',
    'uses' => 'AlbumController@edit'
], function () {})->middleware('permission:edit');

Route::get('/album/create',[
    'as' => 'album.create',
    'uses' => 'AlbumController@create'
], function () {})->middleware('permission:create');
Route::patch('/album/{id}',[
    'uses' => 'AlbumController@update',
    'as' => 'update'
], function () {})->middleware('permission:update');

Route::post('/album',[
    'uses' => 'AlbumController@store',
    'as' => 'store'
], function () {})->middleware('permission:create');

Route::get('/album/{id}','AlbumController@show', function () {})->middleware('permission:show');

Route::delete('/album/{id}','AlbumController@destroy', function () {})->middleware('permission:delete');