<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\IntegrationRule;
use App\Models\Order;
use App\Models\user_coupon;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

	    //统计卡券数量
        $coupons_count = user_coupon::coupons_list($user->id)['un_used']['count'];
    	return view('user.user',[
    			'user'=>$user,
                'coupon_count' => $coupons_count
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
	    if(User::where('key',$keygen)->first()){
	      return \GuzzleHttp\json_encode(['success'=>false,'message'=>'该密钥已被注册！']);
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
            $userPayCode->imgUrl = $randFileName;
            $userPayCode->type = 0;//付款码 未提交
            if($userPayCode->save())
                return \GuzzleHttp\json_encode(array('success'=>true,'img_id'=>$userPayCode->id));
            return \GuzzleHttp\json_encode(array('success'=>false,'message'=>'上传失败！'));

        }

    }
    public function getWechatCode()
    {
        $path = userPayCode::where('user_id',Auth::id())->where('type',1)->orderBy('created_at','desc')->first()->imgUrl;
        $path = storage_path().'/fkm/'.$path;
        return response()->file($path);
    }

    //获取积分兑换规则
    public function getIntegrationInfo()
    {
        $obj = new ExChangeController();

        $game = DB::table('game')
            ->where('status', 1)
            ->select('id', 'name')
            ->get()->toArray();
        $rule = IntegrationRule::find(1);
        if ($rule) {
            $array = Array();
            $array['game'] = $game;
            $array['start_value'] = $rule->start_value;
            $array['get_value'] = $rule->get_value;

            return response()->json($array);
        } else {
            return response()->json(false);
        }
    }

    //积分订单添加
    public function newIntegrationOrder(Request $request)
    {
        $data = $request->all();
        $integration = $data['value'];
        $obj = new Order();
        $rule = IntegrationRule::find(1);
        $arr = Array();
        //判断积分是否大于起兑分值
        if ($data['value'] >= $rule['start_value']) {
            //获取用户信息
            $user = Auth::user()->toArray();
            $id = $user['id'];
            $data['user_id'] = $id;
            $data['type'] = 1;
            $data['money'] = '积分订单';
            //判断输入积分与拥有积分大小
            if ($user['integration'] != '') {
                if ($data['value'] <= $user['integration']) {
                    $rate = $rule->start_value;
                    $value = $rule->get_value;
                    $data['value'] = $data['value']*$value/$rate;

                    foreach ($data as $k=> $v) {
                        $obj -> $k = $v;
                    }
                    $obj -> save();
                    $insertId = $obj -> id;
                  
                    $user = User::find($id);
                    $user -> integration = sprintf("%.2f", $user['integration']-$integration);
                    $user -> save();

                    //积分兑换订单存入memcache
                    $memArr = Array();
                    $memArr['name'] = $user['nickName'];
                    $memArr['type'] = $this::getGameName($data['game_id']);
                    $memArr['money'] = '积分订单';
                    $memArr['value'] = $data['value'];
                    $memArr['account'] = $obj->game_account;
                    $memArr['time'] = date('Y-m-d H:i:s',time());
                    $memArr['id'] = $insertId;
                    $memArr = serialize($memArr);
                    get_memcache('shangfenkey', $insertId, $memArr);


                    //返回数据类型
                    $arr['status'] = 1;
                    $arr['number'] = $this::getGameNumber($data['game_id']);
                    return response()->json($arr);
                } else {
                    $arr['status'] = 3;
                    return response()->json($arr);
                }
            } else {
                $arr['status'] = 4;
                return response()->json($arr);
            }
        } else {
            $arr['status'] = 2;
            $arr['msg'] = $rule['start_value'];
            return response()->json($arr);
        }
    }
  
    public function getZfbCode()
    {
        $path = userPayCode::where('user_id',Auth::id())->where('type',2)->orderBy('created_at','desc')->first()->imgUrl;
        $path = storage_path().'/fkm/'.$path;
        return response()->file($path);
    }

    public function orderList()
    {
        return view('user.orderList');
    }

    public function submitFile(Request $request)
    {
        $file = userPayCode::find($request->input('img_id'));
        if($file){
            $file->type = $request->input('type');
            if($file->save()){
                $data['message'] = 'success';
                return response()->json($data);
            }else{
                $data['message'] = 'false';
                return response()->json($data);
            }
        }
    }

    //获取游戏名称
    public static function getGameName($id)
    {
        $game = Game::find($id);
        return $game -> name;
    }

    //获取房间号
    public static function getGameNumber($id)
    {
        $game = Game::find($id);
        return $game -> up_game_room;
    }
}

