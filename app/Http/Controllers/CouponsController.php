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
use App\Models\user_coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $order = new Order(array_merge($request->input(),['user_id'=>Auth::user()->id]));
        if($order->save()>0){
            //用户卡券标记为已经使用
            $userCoupon = user_coupon::where('code','=',$request->input('value'))->first();
            $userCoupon->is_used = 1;
            $userCoupon->save();
            return MyWoker::jsonSuccess([],'','使用卡券成功！可在个人中心我的消息列表查看具体详情');
        }
    }



}