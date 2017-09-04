<?php

namespace App\Http\Controllers;

use App\Helpers\MyWoker;
use App\Models\Prize;
use App\Models\Prize_detail;
use App\Models\user_coupon;
use App\Models\Wheel_setting;
use Illuminate\Console\Application;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

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
        return MyWoker::jsonSuccess(Prize_detail::format_award_arr(Prize_detail::award_list()));
    }

    /**中哪个奖品的方法
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_award()
    {
        $award_arr = $this->award_list();
        $prize_detail = Prize_detail::find(Prize_detail::get_award());
        $data = Prize_detail::format_award_arr(Prize_detail::award_list());
        if(!$prize_detail->name!='谢谢参与'){
            //向中奖的数据中插入数据
            $userCoupon = new user_coupon([
//                'user_id' =>
            ]);
        }

        return MyWoKer::jsonSuccess(array_search($prize_detail->name,$data['restaraunts'])+1);
    }
}
