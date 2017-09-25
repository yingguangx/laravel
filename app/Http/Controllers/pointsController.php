<?php

namespace App\Http\Controllers;

use App\Helpers\MyWoker;
use App\Models\Prize;
use App\Models\Prize_detail;
use App\Models\user_coupon;
use App\Models\user_play;
use App\Models\Wheel_setting;
use Illuminate\Console\Application;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Memcache;

class pointsController extends Controller
{
    public function index(){
	    return view('user.point');
    }

    /**大转盘显示页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function wheel()
    {
        //判断该大转盘活动是否开启
        if(!Wheel_setting::is_open()){
            return view('user.wheel',[
                    'award_list'=> [],
                    'rules'     => '',
                    'luck_list' => [],
                ]
            );
        }
        return view('user.wheel',[
               'award_list'=> Prize_detail::award_list(),
               'rules'     => Wheel_setting::first(['rules'])->toArray()['rules'],
               'luck_list' => user_coupon::luck_list(),
            ]
        );

    }

    /**奖品列表获取
     * @return \Illuminate\Http\JsonResponse
     */
    public function award_list()
    {
        //判断该大转盘活动是否开启
        if(!Wheel_setting::is_open()){
            return MyWoker::jsonFail('','','该活动有效时间是'.Wheel_setting::get_act_time().',已经停止,敬请期待');
        }
        return MyWoker::jsonSuccess(Prize_detail::format_award_arr(Prize_detail::award_list()));
    }

    /**中哪个奖品的方法
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_award()
    {
        //判断该大转盘活动是否开启
        if(!Wheel_setting::is_open()){
            return MyWoker::jsonFail('','','该活动有效时间是'.Wheel_setting::get_act_time().',已经停止,敬请期待');
        }

        //判断该用户当天是否可玩大转盘
        if(!user_play::can_play(Auth::user()->id)){
            return MyWoker::jsonFail('','','今天抽奖次数已经用完，明天再来哦!');
        }
        $prize_detail_id = Prize_detail::get_award();
        if(empty($prize_detail_id)) return MyWoker::jsonFail('','','活动暂无奖品!');
        $prize_detail = Prize_detail::find($prize_detail_id);
        $data = Prize_detail::format_award_arr(Prize_detail::award_list());
        $userCoupon = '';
        if($prize_detail->deposit!=0 || $prize_detail->prize!=0){
            //向中奖的数据中插入数据
            $userCoupon = new user_coupon([
                'user_id'         => Auth::user()->id,
                'prize_detail_id' => $prize_detail_id,
                'create_time'     => time(),
                'code'            => user_coupon::generate_card_code(),
                'expire_time'     => MyWoker::get_deadline(time(),Wheel_setting::first()->valid_time),
            ]);
           $userCoupon->save();
           $userCoupon = $userCoupon::luck_list($userCoupon->id);
        }
        return MyWoKer::jsonSuccess(['item'=>array_search($prize_detail->name,$data['restaraunts'])+1,'new_luck_list'=>$userCoupon?$userCoupon:'']);
    }

    public function money_change(Request $request)
    {
        $all = $request->all();
        $user = Auth::user()->toArray();
        $nickName = DB::table('users')->where('id',$user['id'])->select('nickName')->first()->nickName;
        $gather_sort = $all['gather_sort'];
        $money = $all['money'];
        if ($user['money'] < $money) {
            return response()->json(['result1'=>false,'issue'=>'余额不足,无法兑换']);
        } else {
            $money_now = $user['money']- $money;
            DB::table('users')->update(['money'=>$money_now]);
        }
        if ($all['gather_account'] == null && $all['gather_name'] == null) {
           $imgUrl_arr = DB::table('user_pay_codes')->where('user_id',$user['id'])->pluck('imgUrl','type');
           if ($gather_sort == '微信') {
            $imgUrl = $imgUrl_arr[1];
           } else if($gather_sort == '支付宝') {
            $imgUrl = $imgUrl_arr[2];
           }
        } else {
           $gather_account = $all['gather_account']; 
           $gather_name = $all['gather_name']; 
        }
        $insert_arr = array('name'=>$nickName,'money'=>$money,'payeesort'=>$gather_sort,'created_at'=>date('Y-m-d H:i:s',time()),'updated_at'=>date('Y-m-d H:i:s',time()));
        if (isset($imgUrl) && !isset($gather_account) && !isset($gather_name)) {
            $insert_arr['payeecode'] = $imgUrl;
        } else if(!isset($imgUrl) && isset($gather_account) && isset($gather_name)) {
             $insert_arr['payeeaccount'] = $gather_account;
             $insert_arr['payeename'] = $gather_name;
        }
        $id = DB::table('money_change')->insertGetId($insert_arr);

        $mem = new Memcache;
        if (!$mem->connect('127.0.0.1',11211)){
            die('连接失败');
        }
        if ($mem->get('moneyChangekey') == false) {
            $mem->set('moneyChangekey', ["moneyChange".$id],MEMCACHE_COMPRESSED,0);
        } else {
            $arr = $mem->get('moneyChangekey');
            $arr[] = "moneyChange".$id;
            $mem->set('moneyChangekey', $arr,MEMCACHE_COMPRESSED,0);
        }
        $all_arr['nickName'] = $nickName;
        $all_arr['gather_sort'] = $gather_sort;
        $all_arr['money'] = $money;
        $all_arr['time'] = date('Y-m-d H:i:s',time());
        $all_arr['nickName'] = $nickName;
        $all_arr['id'] = $id;
         if (isset($imgUrl) && !isset($gather_account) && !isset($gather_name)) {
            $all_arr['imgUrl'] = storage_path().$imgUrl;
        } else if(!isset($imgUrl) && isset($gather_account) && isset($gather_name)) {
            $all_arr['gather_account'] = $gather_account;
            $all_arr['gather_name'] = $gather_name;
        }
        $str_arr = serialize($all_arr);
        $bool = $mem->set("moneyChange".$id,$str_arr,MEMCACHE_COMPRESSED,0);

        return response()->json(['result1'=>true]);
        
    }

    public function judgewx()
    {
       $user = Auth::user()->toArray();
       $wxewm = DB::table('user_pay_codes')
       ->select('imgUrl')
       ->where([
        ['user_id','=',$user['id']],
        ['type','=',1],
        ])->first();
       return response()->json(['wxewm'=>$wxewm]);
    }
    public function judgezfb()
    {
       $user = Auth::user()->toArray();
       $zfbewm = DB::table('user_pay_codes')
       ->select('imgUrl')
       ->where([
        ['user_id','=',$user['id']],
        ['type','=',2],
        ])->first();
       return response()->json(['zfbewm'=>$zfbewm]);
    }
}
