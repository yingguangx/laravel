<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExChangeController extends Controller
{
    //下分兑换页
    public function exChange()
    {
        return view('exChange/exChange');
    }
}
