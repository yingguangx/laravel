<?php

namespace App\Http\Controllers;

use Illuminate\Console\Application;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class helloController extends Controller
{
    public function index(){
    	return view('user.user');
	    $wechat = new \EasyWeChat\Foundation\Application(config('wechat'));
	    $oauth = $wechat->oauth;
	    
	    if (empty($_SESSION['wechat_user'])) {
		    $_SESSION['target_url'] = 'user/profile';
		    return $oauth->redirect();
	    }
	    
	    $user = $_SESSION['wechat_user'];
	    
    	return view('hello');
    }
}
