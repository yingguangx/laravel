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
use Illuminate\Support\Facades\Storage;
use App\Models\UserPayCode;


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
    public function userInfo()
    {
        return view('user.userinfo');
    }

    public function fileUpload(Request $request)
    {
        $file = $request->file('file');
        $types = array('gif','jpeg','jpg','png');
        if($file->isValid()){
            if(!in_array($file->extension(),$types)) return \GuzzleHttp\json_encode(array('success'=>false,'message'=>'暂不支持该文件类型！'));
            $randFileName = md5(str_random(12).time()).'.'.$file->extension();
            $file->move(app_path().'/../storage/fkm',$randFileName);
            $userPayCode = new UserPayCode;
            $userPayCode->user_id = Auth::user()->id;
            $userPayCode->imgUrl = '/fkm/'.$randFileName;
            $userPayCode->type = $request->input('type');//付款码
            if($userPayCode->save())
                return \GuzzleHttp\json_encode(array('success'=>true));
            return \GuzzleHttp\json_encode(array('success'=>false,'message'=>'上传失败！'));

        }

    }
    public function getWechatCode()
    {
        $path = userPayCode::where('user_id',Auth::id())->where('type',1)->orderBy('created_at','desc')->first()->imgUrl;
        $path = storage_path().$path;
        return response()->file($path);
    }
    public function getZfbCode()
    {
        $path = userPayCode::where('user_id',Auth::id())->where('type',2)->orderBy('created_at','desc')->first()->imgUrl;
        $path = storage_path().$path;
        return response()->file($path);
    }
}

