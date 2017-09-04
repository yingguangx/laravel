<?php

namespace App\Models;

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
}
