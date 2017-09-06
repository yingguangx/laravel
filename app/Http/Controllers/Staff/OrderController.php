<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Memcache;

class OrderController extends Controller
{
    // public function __construct()
    // {
    //     dd(11);
    // }
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
        $order = DB::table('order as o')
        ->leftJoin('game as g','o.game_id','=','g.id')
        ->leftJoin('users as u','o.user_id','=','u.id')
        ->select('o.money','o.value','o.created_at','u.name as uname','g.name as gname','o.id')
        ->where('o.status',1)
        ->get();
    	return view('staff.order.xiafen',['orders'=>$order]);
    }

    public function gameSetting()
    {
    	$games = DB::table('game')->get();
    	return view('staff.game.index',['games'=>$games]);
    }

    public function saveGame(Request $request)
    {
    	$all = $request->all();
    	DB::table('game')->insert( ['name' =>$all['game_name'], 'hhwx_rate' => $all['down_rate'],'business_id' => $all['business_id'], 'up_rate' => $all['up_rate'],'created_at'=>date('Y-m-d H:i:s',time()),'updated_at'=>date('Y-m-d H:i:s',time())]);
    	return Redirect::route('staff.gameSetting');
    }

    public function delGame($id)
    {
    	DB::table('game')->where('id',$id)->delete();
    	return Redirect::route('staff.gameSetting');
    }

    public function saveupGame(Request $request)
    {
    	$all = $request->all();
    	DB::table('game')->where('id',$all['gameid'])->update(['name' => $all['game_name_up'],'up_rate' => $all['up_rate_up'],'hhwx_rate' => $all['down_rate_up'],'business_id' => $all['business_id_up']]);
    	return Redirect::route('staff.gameSetting');
    }

    public function shafenOrderIndex()
    {
        return view('staff.order.shafen');
    }

    public function jifenOrderIndex()
    {
        return view('staff.order.jifen');
    }

    public function balanceIndex()
    {
        return view('staff.order.balance');
    }

    public function xiafenok(Request $request)
    {
        $id = $request->input('id');
        $mem = new Memcache;
        if (!$mem->connect('127.0.0.1',11211)){
            die('连接失败');
        }
        $bool = $mem->delete($id,0);
        $bool2 = DB::table('order')->where('id',$id)->update(['status'=>0]);
        return response()->json(['result'=>true]);
    }
}
