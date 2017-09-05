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
        $prize_detail = Prize_detail::find($prize_detail_id);
        $data = Prize_detail::format_award_arr(Prize_detail::award_list());
        $userCoupon = '';
        if($prize_detail->name!='谢谢参与'){
            //向中奖的数据中插入数据
            $userCoupon = new user_coupon([
                'user_id'         => Auth::user()->id,
                'prize_detail_id' => $prize_detail_id,
                'create_time'     => time(),
                'expire_time'     => MyWoker::get_deadline(time(),Wheel_setting::first()->valid_time),
            ]);
           $userCoupon->save();
           $userCoupon = $userCoupon::luck_list($userCoupon->id);
        }
        return MyWoKer::jsonSuccess(['item'=>array_search($prize_detail->name,$data['restaraunts'])+1,'new_luck_list'=>$userCoupon?$userCoupon:'']);
    }
}
