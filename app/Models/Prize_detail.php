<?php

namespace App\Models;

use App\Helpers\MyWoker;
use Illuminate\Database\Eloquent\Model;

class Prize_detail extends Model
{
    public $table = 'prize_detail';
    public $primaryKey = 'prize_detail_id';

    public static function tableName()
    {
        return (new self)->table;
    }

    /**奖品列表
     * @return array
     */
    public static function award_list()
    {
        return self::join(Prize::tableName().' as pz','pz.prize_id','=',self::tableName().'.prize_id')
            ->get()->toArray();
    }

    /**取得中奖的prize_detail_id
     * @return int|string
     */
    public static function get_award()
    {
        $award = self::award_list();
        foreach($award as $v){
            $arr[$v['prize_detail_id']] = $v['probability'];
        }
        return MyWoker::get_award($arr);
    }

    /**
     * 对数据进行格式化
     */
    public static function format_award_arr($data)
    {
        $prize_name = array_column($data,'name');
        $color_arr = ["#FFF4D6", "#FFFFFF"];
        foreach($prize_name as $k => $v){
            $color_arr[] = $color_arr[$k%2];
        }
        return ['restaraunts'=>$prize_name,'color'=>$color_arr];
    }

}
