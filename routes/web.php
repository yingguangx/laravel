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
Route::get('/hello', 'helloController@index');
Route::get('/points', 'pointsController@index');
Route::get('/coupons/{action?}', function(\App\Http\Controllers\CouponsController $controller,$action=null){
    $action = empty($action)?'index':$action;
    if(method_exists($controller,$action)){
        return $controller->$action();
    }
});
