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
    public static function get_award($award)
    {
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

    public static function jsonSuccess($data,$code='',$message=null)
    {
        return response()->json(['code'=>$code?$code:self::CODE_SUC,'data'=>$data,'msg'=>$message?$message:'成功获取数据']);
    }

    public static function jsonFail($data,$code='',$message=null)
    {
        return response()->json(['code'=>$code?$code:self::CODE_ERR,'data'=>$data,'msg'=>$message]);
    }
}