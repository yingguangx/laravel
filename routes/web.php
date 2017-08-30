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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('/hello', 'helloController@index');
});
Route::get('/hello', 'helloController@index');
//上分充值
Route::get('/reChange', 'ReChangeController@reChange');
//下分兑换
Route::get('/exChange', 'ExChangeController@exChange');
Route::get('/points', 'pointsController@index');
Route::get('/user', 'UserController@index');

