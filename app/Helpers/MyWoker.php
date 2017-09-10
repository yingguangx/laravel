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
        return date('Y'.$delimiter.'m'.$delimiter.'d'.' H:i',$time);
    }


    public static function get_deadline($start_time,$expire_day)
    {
        $ctime_begin = mktime(0,0,0,date('m',$start_time),date('d',$start_time),date('Y',$start_time));
        return $ctime_begin + ($expire_day)*3600*24+3600*24-1;
    }


    public static function jsonSuccess($data,$code='',$message=null)
    {
        return response()->json(['code'=>$code?$code:self::CODE_SUC,'data'=>$data,'msg'=>$message?$message:'成功获取数据']);
    }

    public static function jsonFail($data,$code='',$message=null)
    {
        return response()->json(['code'=>$code?$code:self::CODE_ERR,'data'=>$data,'msg'=>$message]);
    }

    public static function generateCode( $nums,$exist_array='',$code_length = 6,$prefix = '')
    {

        $characters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz";
        $promotion_codes = array();//这个数组用来接收生成的优惠码

        for($j = 0 ; $j < $nums; $j++) {

            $code = '';

            for ($i = 0; $i < $code_length; $i++) {

                $code .= $characters[mt_rand(0, strlen($characters)-1)];

            }

            //如果生成的4位随机数不再我们定义的$promotion_codes数组里面
            if( !in_array($code,$promotion_codes) ) {

                if( is_array($exist_array) ) {

                    if( !in_array($code,$exist_array) ) {//排除已经使用的优惠码

                        $promotion_codes[$j] = $prefix.$code; //将生成的新优惠码赋值给promotion_codes数组

                    } else {

                        $j--;

                    }

                } else {

                    $promotion_codes[$j] = $prefix.$code;//将优惠码赋值给数组

                }

            } else {
                $j--;
            }
        }

        return $promotion_codes;
    }
}