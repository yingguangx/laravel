<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class userPayCode extends Model
{
    protected $fillable = ['user_id', 'imgUrl', 'type'];
}
