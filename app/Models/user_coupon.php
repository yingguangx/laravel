<?php

namespace App\Models;

use App\Helpers\MyWoker;
use Illuminate\Database\Eloquent\Model;

class user_coupon extends Model
{
    protected $fillable = ['user_id', 'prize_detail_id', 'create_time', 'expire_time'];

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
        $base_field = ['user_id','create_time','expire_time','pd.name'];
        $table_name = (new self)->getTable();
        $query = self::where('user_id','=',$user_id)
                ->orderBy('create_time','desc')
                ->join(Prize_detail::tableName().' as pd','pd.prize_detail_id','=',$table_name.'.prize_detail_id');
        ;
        $un_used = (clone $query)->where('is_used','=',0);
        $used_query = (clone $query)->where('is_used','=','1');

        return [
          'un_used'=>[
              'count' => $un_used->count(),
              'list'  => $un_used->get($base_field)->transform(function($item,$key){
                    $item['time'] = MyWoker::format_time($item['create_time']).' 至 '.MyWoker::format_time($item['expire_time']);
                    return $item;
              })->toArray(),
          ],
          'used'=>[
              'count' => $used_query->count(),
              'list'  => $used_query->get($base_field)->transform(function($item,$key){
                  $item['time'] = MyWoker::format_time($item['create_time']).' 至 '.MyWoker::format_time($item['expire_time']);
                  return $item;
              })->toArray(),
          ]
        ];
    }
}
