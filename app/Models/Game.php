<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public $table = 'game';


    public static function game_list()
    {
        return self::where('status','=',1)->get(['name','id'])->toArray();
    }
}
