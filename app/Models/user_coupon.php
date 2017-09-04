<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_coupon extends Model
{
    /**
     * 中奖名单
     */
    public static function luck_list()
    {
        $table_name = (new self)->getTable();
        return self::join('users','users.id','=',$table_name.'.user_id')
            -> join(Prize_detail::tableName().' as pd','pd.prize_detail_id','=',$table_name.'.prize_detail_id')
            -> orderBy($table_name.'.create_time','desc')
            -> get(['users.nickName',$table_name.'.*','pd.name'])
            -> toArray();
    }
}
