<?php

namespace App\Http\Controllers;

use App\Models\Prize;
use App\Models\Prize_detail;
use Illuminate\Console\Application;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class pointsController extends Controller
{
    public function index(){
	    return view('user.point');
    }

    public function wheel()
    {
        dd(Prize_detail::find(1)->prize);
	    return view('user.wheel');
    }
}
