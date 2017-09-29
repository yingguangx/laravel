<?php

namespace App\Models;

use App\Helpers\MyWoker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Wheel_setting extends Model
{
    public $fillable = ['start_time','finish_time','play_num','rules','valid_time'];
    public $primaryKey = 'wheel_setting_id';

    /**判断活动是否开启
     * @return bool
     */
    public static function is_open()
    {
        $ctime = time();

        $data = self::first(['start_time','finish_time']);
        if(empty($data)){
            return true;
        }else{
            $data = $data ->toArray();
        }

        //没有设置活动时间
        if(empty($data)){
            return true;
        }

        //在活动时间里
        if($data['start_time'] <= $ctime && $data['finish_time'] >= $ctime){
            return true;
        }

        //已经过了活动时间
        return false;
    }


    /**取得活动时间
     *
     */
    public static function get_act_time()
    {
        $data = self::first(['start_time','finish_time']);
        if(empty($data)){
            return '';
        }else{
            $data=  $data -> toArray();
        }
        if(!empty($data)){
            return MyWoker::format_time($data['start_time'],'-',true).'至'.MyWoker::format_time($data['finish_time'],'-',true);
        }
        return '';
    }

}
