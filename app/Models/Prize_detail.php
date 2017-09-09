<?php

namespace App\Models;

use App\Helpers\MyWoker;
use Illuminate\Database\Eloquent\Model;

class Prize_detail extends Model
{
    public $fillable = ['prize_id','name','deposit','prize','status'];
    public $table = 'prize_detail';
    public $primaryKey = 'prize_detail_id';
    public static $param_data = [];
    public static function tableName()
    {
        return (new self)->table;
    }

    /**奖品列表
     * @return array
     */
    public static function award_list()
    {
        return self::join(Prize::tableName().' as pz','pz.prize_id','=',self::tableName().'.prize_id')->where('status','=','1')->get()->toArray();
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

    /**修改或者添加奖项
     * @param $data
     * @return bool
     */
    public static function save_award($data)
    {
        if(empty($data['prize_id'])){

            //添加
            //添加到prize表
            $prize_model = new Prize($data);
            $res1 = $prize_model ->save();
            $data['prize_id'] = $prize_model->prize_id;
            $prize_detail_model = new Prize_detail($data);
            $res2 = $prize_detail_model ->save();
        }else{

            //保存
            //保存到prize表
            $prize_model = Prize::find($data['prize_id']);
            $prize_detail_model = Prize_detail::find($data['prize_detail_id']);

            $res1 = $prize_model -> update($data);
            $res2 = $prize_detail_model->update(['status'=>0]);
            $prize_detail_model = new Prize_detail($data);
            $res3 = $prize_detail_model->save();
        }

        self::$param_data = [
            'prize_id'        =>$prize_model->prize_id,
            'prize_detail_id' =>$prize_detail_model->prize_detail_id,
        ];
        return !isset($res3)?$res1 && $res2 : $res1 && $res2 && $res3;
    }

    /**奖项的删除
     * @param $data
     * @return bool
     */
    public static function award_delete($data)
    {
        if(empty($data['prize_detail_id'] || empty($data['prize_id']))){
            return true;
        }

        Prize::find($data['prize_id'])->delete();
        Prize_detail::find($data['prize_detail_id'])->update(['status'=>0]);
        return true;
    }

}
