<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Memcache;

class OrderController extends Controller
{
    public function getmessage()
    {
    	$mem = new Memcache;
    	if (!$mem->connect('127.0.0.1',11211)){
    		die('连接失败');
    	}
    	if ($mem->get('xiafenkey') != false) {
    		$xiafenorders = $mem->get($mem->get('xiafenkey'));
    	} else {
    		$xiafenorders = [];
    	}
    	return response()->json(['xiafenorders'=>$xiafenorders]);
    }

    public function xiafenOrderIndex()
    {
    	return view('staff.order.xiafen');
    }

    public function gameSetting()
    {
    	$games = DB::table('game')->get();
    	return view('staff.game.index',['games'=>$games]);
    }

    public function saveGame(Request $request)
    {
    	$all = $request->all();
    	DB::table('game')->insert( ['name' =>$all['game_name'], 'hhwx_rate' => $all['down_rate'],'business_id' => $all['business_id'], 'up_rate' => $all['up_rate'],'created_at'=>time(),'updated_at'=>time()]);
    	return Redirect::route('staff.gameSetting');
    }
}
