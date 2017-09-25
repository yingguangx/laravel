<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    public $fillable = ['game_id','game_account','money','value','user_id','type'];



    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
