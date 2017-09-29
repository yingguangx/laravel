<?php

namespace App\Http\Controllers\Staff;

use App\Helpers\MyWoker;
use App\Models\Prize;
use App\Models\Prize_detail;
use App\Models\StaffInfo;
use App\Models\Wheel_setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Staff\LoginController;


class WheelController extends Controller
{
    public function index()
    {
        $base_setting = Wheel_setting::first();
        if(empty($base_setting)){
            $base_setting = [];
            $base_setting['play_num'] = 0;
            $base_setting['rules'] = '';
            $base_setting['start_time'] = '';
            $base_setting['finish_time'] = '';
        }else{
            $base_setting['start_time'] =  MyWoker::format_time($base_setting['start_time'],'-',true);
            $base_setting['finish_time'] =  MyWoker::format_time($base_setting['finish_time'],'-',true);
        }

        $award_list = Prize_detail::award_list();
        return view('staff.wheel.index',[
            'base_setting' => $base_setting,
            'award_list'=> $award_list,
        ]);
    }


    public function base_setting(Request $request)
    {
        $wheel_model = Wheel_setting::first();
        if(empty($wheel_model)){
            $insert = array_merge($request->all(),['valid_time'=>10]);
            $res = (new Wheel_setting(self::format_time($insert)))->save();
        }else{
            $res = $wheel_model->update(self::format_time($request->all()));
        }
        return $res ? MyWoker::jsonSuccess('','','操作成功'):MyWoker::jsonFail('','','操作成功');
    }

    /**格式化时间
     * @param $data
     * @return mixed
     */
    public static function format_time($data)
    {
        $data['start_time'] = strtotime($data['start_time']);
        $data['finish_time'] = strtotime($data['finish_time']);
        return $data;
    }


    /**奖项的保存或者修改
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function award_add_save(Request $request)
    {
        Prize_detail::save_award($request->all());
        return MyWoker::jsonSuccess(Prize_detail::$param_data,'','操作成功');
    }

    /**奖项的删除
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function award_delete(Request $request)
    {
        Prize_detail::award_delete($request->all());
        return MyWoker::jsonSuccess('','','删除成功');
    }
}