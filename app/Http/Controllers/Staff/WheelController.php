<?php

namespace App\Http\Controllers\Staff;

use App\Models\StaffInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Staff\LoginController;


class WheelController extends Controller
{
    public function index()
    {
        return view('staff.wheel.index');
    }
}