<?php

namespace App;

use App\Models\Order;
use App\Models\userPayCode;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','nickName'
    ];

    protected $appends = [
        'has_wechat_code','has_zfb_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userPayCode()
    {
        return $this->hasMany(userPayCode::class, 'user_id', 'id');
    }
    public function userOrder()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    public function getHasWechatCodeAttribute()
    {
        $codes = $this->userPayCode;
        foreach ($codes as $code){
            if($code->type == 1){
                return 'true';
            }
        }
        return 'false';
    }
    public function getHasZfbCodeAttribute()
    {
        $codes = $this->userPayCode;
        foreach ($codes as $code){
            if($code->type == 2){
                return 'true';
            }
        }
        return 'false';
    }
}
