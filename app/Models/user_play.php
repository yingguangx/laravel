<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_play extends Model
{
    public static $errors; //存储错误信息的容器
    public $fillable = ['user_id','play_num','play_time'];

    /**判断当前用户是否可转大转盘
     * @param $user_id  用户id
     * @return bool     true-可转 false-不可转
     */
    public static function can_play($user_id)
    {
        if($setting = Wheel_setting::first()){
            $user_play = user_play::where('user_id','=',$user_id)->first();
            if(empty($user_play)){

                //从来没有玩过大转盘
                $user_play = new user_play([
                    'user_id'  => $user_id,
                    'play_num' => 1,
                    'play_time'=> time(),
                ]);
                $user_play->save();
                return true;
            }

            $ctime_begin = mktime(0,0,0,date('m'),date('d'),date('Y'));
            $ctime_end = $ctime_begin + 24*3600;

            //如果当天已经玩过了大转盘
            if($user_play->play_time >= $ctime_begin && $user_play->play_time < $ctime_end){

                //判断次数是否超过了每人每天可玩的次数限制
                if( $setting->play_num >= $user_play->play_num + 1){
                    $user_play->play_num += 1;
                    $user_play->play_time = time();
                    $user_play->save();
                    return true;
                }
                return false;
            }else{
                //当天没有玩过大转盘
                $user_play->play_time = time();
                $user_play->play_num  = 1;
                $user_play->save();
                return true;
            }

        }

        return true;

    }
}
