<?php
/**
 * Created by PhpStorm.
 * User: farewell
 * Date: 2017/9/10
 * Time: 17:03
 */

namespace App\Http\Controllers\Staff;


use App\Helpers\MyWoker;
use App\Http\Controllers\Controller;
use App\Models\Wheel_setting;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    //卡券设置首页
    public function index()
    {
        $wheel_model = Wheel_setting::first();
        if(empty($wheel_model)){
            $wheel_model = ['valid_time'=> ''];
        }
        return view('staff.coupons.index',[
            'wheel_model' => $wheel_model
        ]);
    }

    /**
     * 卡券设置
     */
    public function setting(Request $request)
    {
        $wheel_model = Wheel_setting::first();
        if(empty($wheel_model)){
            $wheel_model = new Wheel_setting($request->all());
            $res = $wheel_model->save();
        }else{
            $res = $wheel_model -> update($request->all());
        }

        return $res?MyWoker::jsonSuccess('','','修改成功'):MyWoker::jsonFail('','','修改失败');
    }
}