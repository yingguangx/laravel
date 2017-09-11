<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class TurnOverController extends Controller
{
    //经营状况首页
    public function turnOver()
    {	
    	$game_arr = DB::table('game')->pluck('name','id')->toArray();
    	$chengben_arr = DB::table('game')->pluck('cost_price','id')->toArray();

    	$small_time = date('Y-m-d H:i:s',strtotime(date('Y-m-d',time())));
    	$big_time = date('Y-m-d H:i:s',strtotime(date('Y-m-d',time()))+60*60*24);
    	$shangfen_real = DB::table('order')->select(DB::raw('SUM(value) as total_value'),DB::raw('SUM(money) as total_money'),'game_id')->where([['type','=',1],['created_at','>',$small_time],['created_at','<',$big_time]])->groupBy('game_id')->get()->toArray();
    	$send_real = DB::table('order')->select(DB::raw('SUM(value) as total_value'),DB::raw('SUM(money) as total_money'),'game_id')->where([['type','=',3],['created_at','>',$small_time],['created_at','<',$big_time]])->orwhere([['type','=',4],['created_at','>',$small_time],['created_at','<',$big_time]])->groupBy('game_id')->get()->toArray();
    	$xiafen_real = DB::table('order')->select(DB::raw('SUM(value) as total_value'),DB::raw('SUM(money) as total_money'),'game_id')->where([['type','=',2],['created_at','>',$small_time],['created_at','<',$big_time]])->groupBy('game_id')->get()->toArray();
    	$arr_exists_shangfen_real = [];
    	foreach ($shangfen_real as $key => $value) {
    		$arr_exists_shangfen_real[] = $value->game_id;
    	}
    	$arr_exists_send_real = [];
    	foreach ($send_real as $key => $value) {
    		$arr_exists_send_real[] = $value->game_id;
    	}
    	$arr_exists_xiafen_real = [];
    	foreach ($xiafen_real as $key => $value) {
    		$arr_exists_xiafen_real[] = $value->game_id;
    	}
    	if (count($shangfen_real) < count($game_arr)) {
    		foreach ($game_arr as $key => $game) {
    			if (!in_array($key, $arr_exists_shangfen_real)) {
	    			$obj3 = (object)array();
	    			$obj3->total_value = 0;
	    			$obj3->game_id = $key;
	    			$obj3->total_money = 0;
	    			$shangfen_real[] = $obj3;
    			}
    		}
    	}
    	if (count($send_real) < count($game_arr)) {
    		foreach ($game_arr as $key => $game) {
    			if (!in_array($key, $arr_exists_send_real)) {
	    			$obj4 = (object)array();
	    			$obj4->total_value = 0;
	    			$obj4->game_id = $key;
	    			$obj4->total_money = 0;
	    			$send_real[] = $obj4;
    			}
    		}
    	}
    	if (count($xiafen_real) < count($game_arr)) {
    		foreach ($game_arr as $key => $game) {
    			if (!in_array($key, $arr_exists_xiafen_real)) {
	    			$obj5 = (object)array();
	    			$obj5->total_value = 0;
	    			$obj5->game_id = $key;
	    			$obj5->total_money = 0;
	    			$xiafen_real[] = $obj5;
    			}
    		}
    	}
    	$gain = 0;
    	foreach ($chengben_arr as $key => $game) {
    		foreach ($shangfen_real as $k => $shangfen) {
    			if ($key == $shangfen->game_id) {
    			
    				$gain =$gain+($shangfen->total_money-$shangfen->total_value/10000*$game);
    			}
    		}
    		foreach ($send_real as $k => $send) {
    			if ($key == $send->game_id) {
    				
    				$gain =$gain-($send->total_value/10000*$game);
    			}
    		}
    		foreach ($xiafen_real as $kk => $xiafen) {
    			if ($key == $xiafen->game_id) {
    				
    				$gain =$gain+($xiafen->total_value/10000*$game-$xiafen->total_money);
    			}
    		}
    	}
    	$money_insert = DB::table('money_insert')->where([['created_at','>',$small_time],['created_at','<',$big_time]])->select(DB::raw('SUM(money) as total_money'))->first()->total_money;
    	if ($money_insert == null) {
    		$money_insert = 0;
    	}
    	$money_change = DB::table('money_change')->where([['created_at','>',$small_time],['created_at','<',$big_time]])->select(DB::raw('SUM(money) as total_money'))->first()->total_money;
    	if ($money_change == null) {
    		$money_change = 0;
    	}
    	$money_diff = $money_insert-$money_change;

    	
    	// dd($xiafen_real);
    	// dd($money_diff);
    	$shangfen_values = DB::table('order as o')
    	->leftjoin('game as g','o.game_id','=','g.id')
    	->select(DB::raw('SUM(o.value) as total_values'),'o.game_id as gid','g.name as gname')->where([['o.type','=',1],['o.created_at','>',$small_time],['o.created_at','<',$big_time]])->orwhere([['o.type','=',3],['o.created_at','>',$small_time],['o.created_at','<',$big_time]])->orwhere([['o.type','=',4],['o.created_at','>',$small_time],['o.created_at','<',$big_time]])->groupBy('o.game_id','g.name')->get()->toArray();

    	$xiafen_values = DB::table('order as o')
    	->leftjoin('game as g','o.game_id','=','g.id')
    	->select(DB::raw('SUM(o.value) as total_values'),'o.game_id as gid','g.name as gname')->where('o.type',2)->groupBy('o.game_id','g.name')->get()->toArray();
    
    	$arr_exists_shangfen = [];
    	$arr_exists_xiafen = [];
    	foreach ($shangfen_values as $key => $value) {
    		$arr_exists_shangfen[] = $value->gid;
    	}
    	foreach ($xiafen_values as $key => $value) {
    		$arr_exists_xiafen[] = $value->gid;
    	}

    	if (count($shangfen_values) < count($game_arr)) {
    		foreach ($game_arr as $key => $game) {
    			if (!in_array($key, $arr_exists_shangfen)) {
	    			$obj1 = (object)array();
	    			$obj1->total_values = 0;
	    			$obj1->gid = $key;
	    			$obj1->gname = $game;
	    			$shangfen_values[] = $obj1;
    			}
    		}
    	}
    	if (count($xiafen_values) < count($game_arr)) {
    		foreach ($game_arr as $key => $game) {
    			if (!in_array($key, $arr_exists_xiafen)) {
	    			$obj2 = (object)array();
	    			$obj2->total_values = 0;
	    			$obj2->gid = $key;
	    			$obj2->gname = $game;
	    			$xiafen_values[] = $obj2;
    			}
    		}
    	}
    	// dd($shangfen_values);

    	$arr = [];
    	foreach ($xiafen_values as $key => &$value) {
    		foreach ($shangfen_values as $k => &$val) {
    			if ($value->gid == $val->gid) {
    				$arr[$val->gid] = ['differ'=>$value->total_values-$val->total_values,'gname'=>$val->gname];
    			}
    		}
    	}
    	// dd($arr);
        return view('staff/turnOver/index',['game_value'=>$arr,'money_diff'=>$money_diff,'gain'=>$gain]);
    }
}
