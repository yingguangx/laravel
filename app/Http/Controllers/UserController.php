<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Console\Application;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
	    if(getUserAgent() == 'Weixin'){
	    $user = session('wechat.oauth_user'); // 拿到授权用户资料
          echo 1;die;
	    }else{
	      $user = Auth::user();
//	      $user->status = 0;
//	      $user->email = '2323@163.com';
//	      $user->name = 1;
//	      $user->save();
//	      dd($user);
	    }
    	return view('user.user',[
    			'user'=>$user,
	    ]);
//	    $wechat = new \EasyWeChat\Foundation\Application(config('wechat'));
//	    $oauth = $wechat->oauth;
//
//	    if (empty($_SESSION['wechat_user'])) {
//		    $_SESSION['target_url'] = 'user/profile';
//		    return $oauth->redirect();
//	    }
//
//	    $user = $_SESSION['wechat_user'];
//
//    	return view('hello');
    }
    public function addKeyGen(Request $request)
    {
    	$userID = $request->input('userID');
    	$keygen = $request->input('keygen');
    	if($userID != Auth::user()->id){
    		return \GuzzleHttp\json_encode(['success'=>false,'message'=>'参数错误，请稍后再试！']);
	    }
	    if($keygen == ''){
    		return \GuzzleHttp\json_encode(['success'=>false,'message'=>'缺少参数！']);
	    }
	    $user = User::find($userID);
	    $user->key = $keygen;
	    if($user->save())
	    	return \GuzzleHttp\json_encode(['success'=>true,'message'=>'设置密钥成功！']);
	    return \GuzzleHttp\json_encode(['success'=>false,'message'=>'设置密钥是失败，请稍后再试']);
    }
}
