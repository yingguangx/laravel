<?php
/**
 * Created by PhpStorm.
 * User: chindor
 * Date: 2017/8/30
 * Time: 19:00
 */

namespace App\Http\Controllers;
use App\Helpers\MyWoker;
use App\Models\Game;
use App\Models\Order;
use App\Models\Prize_detail;
use App\Models\user_coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**卡券 大转盘控制器
 * Class CouponsController
 * @package App\Http\Controllers
 */
class CouponsController extends Controller
{
    public function index()
    {
        $game_lsit = Game::game_list();
        $coupon_list = user_coupon::coupons_list(Auth::user()->id);
        return view('coupons.card_index',['coupon_list'=>$coupon_list,'game_list'=>$game_lsit]);
    }

    public function show()
    {
        return view('coupons.wheel');
    }

    /**使用卡券
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function use_card(Request $request)
    {
        if(!user_coupon::check_code($request->input('value'))){
            return MyWoker::jsonFail('','','不是有效的卡券码！');
        }

        //判断卡券的充值类型是否满足
        $prize_detail_id = user_coupon::where('code','=',$request->input('value'))->first()['prize_detail_id'];

        if(!empty($prize_detail_id)){
            $prize_detail = Prize_detail::where('prize_detail_id','=',$prize_detail_id)->first();
            $deposit = $prize_detail -> deposit;
            $prize = $prize_detail   -> prize;

            $today_begin = mktime(0,0,0,date('m'),date('d'),date('Y'));
            $today_end   = $today_begin +24*3600;
            $today_money = Order::where('user_id','=',Auth::user()->id)->whereRaw('UNIX_TIMESTAMP(created_at) between '.$today_begin.' and '.$today_end)->where('type','=','1')->where('money','<>','卡券')->sum('money');
            if($today_money < $deposit){
                return MyWoker::jsonFail('','','当日充值金额'.$today_money.'元,未满'.$deposit.'元!');
            }
        }
        //生成订单
        $order = new Order(array_merge($request->input(),['user_id'=>Auth::user()->id,'type'=>1,'value'=>$prize]));
        if($order->save()>0){

            //用户卡券标记为已经使用
            $userCoupon = user_coupon::where('code','=',$request->input('value'))->first();
            $userCoupon->is_used = 1;
            $userCoupon->save();

            //存入memcache
            $memArr = Array();
            $memArr['name'] = Auth::user() -> nickName;
            $memArr['type'] = Game::where('id','=',$request->input('game_id'))->first()->name;
            $memArr['money'] = '卡券';
            $memArr['value'] = $prize;
            $memArr['account'] = $request->input('game_account');
            $memArr['time'] = date('Y-m-d H:i:s');
            $memArr['id'] = $order->id;
            $memArr = serialize($memArr);
            get_memcache('shangfenkey',$order->id,$memArr);
            return MyWoker::jsonSuccess([],'','使用卡券成功！可在个人中心我的消息列表查看具体详情');
        }
    }



}