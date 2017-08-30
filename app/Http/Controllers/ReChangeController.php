<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReChangeController extends Controller
{
    //上分充值页
    public function reChange()
    {
        return view('reChange/reChange');
    }
}
