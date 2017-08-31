<?php

namespace App\Http\Controllers;

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
	    return view('user.wheel');
    }
}
