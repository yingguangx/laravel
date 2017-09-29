<?php

namespace App\Models;

use App\Helpers\MyWoker;
use Illuminate\Database\Eloquent\Model;

class user_coupon extends Model
{
    protected $fillable = ['user_id', 'prize_detail_id', 'create_time', 'expire_time','code'];

    /**
     * 中奖名单
     */
    public static function luck_list($id='')
    {
        $table_name = (new self)->getTable();

        $query = self::join('users','users.id','=',$table_name.'.user_id')
            -> join(Prize_detail::tableName().' as pd','pd.prize_detail_id','=',$table_name.'.prize_detail_id')
            -> orderBy($table_name.'.create_time','desc');
        if(empty($id)){
            return $query -> get(['users.nickName',$table_name.'.*','pd.name'])
                   -> toArray();
        }
        return $query->where($table_name.'.id','=',$id)->first()->toArray();
    }

    /**获得用户卡券列表也的数据
     * @param $user_id
     * @return array
     */
    public static function coupons_list($user_id)
    {
        $base_field = ['user_id','create_time','expire_time','pd.name','pd.prize_detail_id','code'];
        $table_name = (new self)->getTable();
        $query = self::where('user_id','=',$user_id)
                ->orderBy('create_time','desc')
                ->join(Prize_detail::tableName().' as pd','pd.prize_detail_id','=',$table_name.'.prize_detail_id');
        ;
        $un_used =(clone $query)->where('is_used','=',0)->where('expire_time','>=',time());
        $used_query =(clone $query)->where('expire_time','<',time());

        return [
          'un_used'=>[
              'count' => $un_used->count(),
              'list'  => $un_used->get($base_field)->transform(function($item,$key){
                    $item['time'] = MyWoker::format_time($item['create_time']).' 至 '.MyWoker::format_time($item['expire_time']);
                    return $item;
              })->toArray(),
          ],
          //已经过期的卡券
          'used'=>[
              'count' => $used_query->count(),
              'list'  => $used_query->get($base_field)->transform(function($item,$key){
                  $item['time'] = MyWoker::format_time($item['create_time']).' 至 '.MyWoker::format_time($item['expire_time']);
                  return $item;
              })->toArray(),
          ]
        ];
    }

    /**检查是否是有效的卡券
     * @param $code
     * @return bool
     */
    public static function check_code($code)
    {
        if(empty(self::where('code','=',$code)->first())){
            return false;
        }
        return true;
    }

    /**生成12位唯一卡券码的方法
     * @return mixed
     */
    public static function generate_card_code()
    {
        $data = self::get(['code'])->toArray();
        if(empty($data)){
            $arr = [];
        }else{
            $arr = array_column($data,'code');
        }

        return MyWoker::generateCode(1,$arr,12)[0];
    }
}
