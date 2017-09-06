<?php
/**
 * Created by PhpStorm.
 * User: chindor
 * Date: 2017/8/30
 * Time: 19:00
 */

namespace App\Http\Controllers;
use App\Models\user_coupon;
use Illuminate\Support\Facades\Auth;

/**卡券 大转盘控制器
 * Class CouponsController
 * @package App\Http\Controllers
 */
class CouponsController extends Controller
{
    public function index()
    {
        $coupon_list = user_coupon::coupons_list(Auth::user()->id);
        return view('coupons.card_index',['coupon_list'=>$coupon_list]);
    }

    public function show()
    {
        return view('coupons.wheel');
    }

}