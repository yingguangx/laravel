<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    public $table = 'prize';
    public $primaryKey = 'prize_id';

    public static function tableName()
    {
        return (new self)->table;
    }
}
