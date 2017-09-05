<?php
/**
 * Created by PhpStorm.
 * User: chindor
 * Date: 2017/9/4
 * Time: 14:24
 */

namespace App\Helpers;


class MyWoker
{

    const CODE_SUC = 200;
    const CODE_ERR = 400;

    /*根据各个奖品的中奖几率取出中奖的物品
     * @param $award
     * @return int|string
     */
    public static function get_award($award=[])
    {
        if(empty($award)){
            return '';
        }
        $random = mt_rand(1,array_sum($award));
        foreach($award as $k => $v){
            if($random <= $v){
                $result = $k;
                break;
            }else{
                $random-=$v;
            }
        }
        return $result;
    }

    /**
     * @param int $time              时间戳 默认为当前时间
     * @param $delimiter             时间分隔符 默认为-
     * @param $hms                   是否精确到时分秒
     * @return false|string
     */
    public static function format_time($time,$delimiter='-',$hms=false)
    {
        if(empty($hms)){
            return date('Y'.$delimiter.'m'.$delimiter.'d',$time);
        }
        return date('Y'.$delimiter.'m'.$delimiter.'d'.' H:m:s',$time);
    }


    public static function get_deadline($start_time,$expire_day)
    {
        $ctime_begin = mktime(0,0,0,date('m',$start_time),date('d',$start_time),date('Y',$start_time));
        return $ctime_begin + ($expire_day+1)*3600*24;
    }


    public static function jsonSuccess($data,$code='',$message=null)
    {
        return response()->json(['code'=>$code?$code:self::CODE_SUC,'data'=>$data,'msg'=>$message?$message:'成功获取数据']);
    }

    public static function jsonFail($data,$code='',$message=null)
    {
        return response()->json(['code'=>$code?$code:self::CODE_ERR,'data'=>$data,'msg'=>$message]);
    }
}