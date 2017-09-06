<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    public $fillable = ['game_id','game_account','money','value','user_id'];
}
