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
Auth::routes();

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
Route::get('/coupons/{action?}', function(\App\Http\Controllers\CouponsController $controller,$action=null){
	$action = empty($action)?'index':$action;
	if(method_exists($controller,$action)){
		return $controller->$action();
	}
});
//Route::group(['middleware' => ['web', 'wechat.oauth']], function () {
Route::group(['middleware' => ['auth']], function () {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/hello', 'helloController@index');
	//上分充值
	Route::get('/reChange', 'ReChangeController@reChange');
    Route::post('/getRate', 'ReChangeController@getRate');
    Route::post('/newOrder', 'ReChangeController@newOrder');
	//下分兑换
	Route::get('/exChange', 'ExChangeController@exChange');
	Route::get('/points', 'pointsController@index');
	Route::post('/coupons/use_card','CouponsController@use_card');
    Route::get('/coupons/index','CouponsController@index');


	//	Route::get('/user', 'UserController@index');
	Route::get('/user', 'UserController@index');
	Route::post('/user/keygen', 'UserController@addKeyGen');
	Route::get('/user/userInfo', 'UserController@userInfo');
	Route::post('/user/fileUpload', 'UserController@fileUpload');
	Route::get('/wheel', 'pointsController@wheel');
  Route::get('/wheel/award_list', 'pointsController@award_list')->name('wheel.award');
  Route::get('/wheel/award', 'pointsController@get_award')->name('wheel.award_random');
	//获取游戏表id
	Route::post('/getGamesinfo', 'ExChangeController@getGamesinfo');
	//下分
	Route::post('/xiafensubmit', 'ExChangeController@xiafensubmit');
	//test
	Route::get('/test', 'ExChangeController@test');
});

//员工端
Route::group(['prefix' => 'staff','namespace' => 'Staff'],function ($router)
{
    $router->get('', 'LoginController@login')->name('staff.index');
    $router->get('login', 'LoginController@login')->name('staff.login');
    $router->post('dologin', 'LoginController@dologin')->name('staff.dologin');
    $router->get('loginOut', 'LoginController@loginOut')->name('staff.loginOut');
    $router->get('index', 'LoginController@staffIndex')->name('staff.index');
    $router->get('integrationSetting', 'IntegrationController@integrationSetting');
    $router->post('addIntegration', 'IntegrationController@addIntegration');
    $router->post('editIntegration', 'IntegrationController@editIntegration');
    $router->get('xiafenOrderIndex', 'OrderController@xiafenOrderIndex');
    $router->get('shafenOrderIndex', 'OrderController@shafenOrderIndex');
    $router->get('jifenOrderIndex', 'OrderController@jifenOrderIndex');
    $router->get('balanceIndex', 'OrderController@balanceIndex');
    $router->get('gameSetting', 'OrderController@gameSetting')->name('staff.gameSetting');
    $router->get('delGame/{id}', 'OrderController@delGame');
    $router->post('getmessage', 'OrderController@getmessage');
    $router->post('saveGame', 'OrderController@saveGame');
    $router->post('saveupGame', 'OrderController@saveupGame');
    $router->post('xiafenok', 'OrderController@xiafenok');
});
Route::get('/wheel', 'pointsController@wheel');
Route::post('/money_change', 'pointsController@money_change');
