<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TurnOverController extends Controller
{
    //经营状况首页
    public function turnOver()
    {
        return view('staff/turnOver/index');
    }
}
