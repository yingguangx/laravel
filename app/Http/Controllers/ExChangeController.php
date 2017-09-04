<?php

namespace App\Http\Controllers;

use Illuminate\Cache\MemcacheConnector;
use Illuminate\Http\Request;
use DB,Session,Redirect,Excel,Cache,URL;
use Memcache;

class ExChangeController extends Controller
{
    //下分兑换页
    public function exChange()
    {	
    	$games = DB::table('game')->select('id','name')->get();
        return view('exChange/exChange',['games'=>$games]);
    }

    public function getGamesinfo(Request $request)
    {
    	 $games = DB::table('game')->select('id','hhwx_rate','business_id','name')->get()->toArray();
    	 $arr1 = [];
    	 foreach ($games as $key => $game) {
    	 	$arr1[$game->id]['hhwx_rate'] = $game->hhwx_rate;
    	 	$arr1[$game->id]['business_id'] = $game->business_id;
    	 	$arr1[$game->id]['name'] = $game->name;
    	 }
    	 return response()->json(['result1'=>$arr1]);
    }


    public function xiafensubmit(Request $request)
    {
    	$all = $request->all();
    	$mem = new Memcache;
    	if (!$mem->connect('127.0.0.1',11211)){
    		die('连接失败');
    	}
    	$money = (int)($all['txt']/$all['hhwx_rate']);
    	$money = round($money);
    	$id = DB::table('order')->insertGetId(
		    ['game_id' => $all['play_sort'], 'game_account' => $all['play_id'],'value'=>$all['txt'],'money'=>$money,'user_id'=>1]
		);
    	if ($mem->get('xiafenkey') == false){
    		$mem->set('xiafenkey', [$id],MEMCACHE_COMPRESSED,0);
    	} else {
    		$arr = $mem->get('xiafenkey');
    		$arr[] = $id;
    		$mem->set('xiafenkey', $arr,MEMCACHE_COMPRESSED,0);
    	}
    	$all['money'] = $money;
    	$bool = $mem->set($id,$all,MEMCACHE_COMPRESSED,0);
    	return response()->json(['result1'=>true]);
    }

    public function test()
    {
    	$mem = new Memcache;
    	if (!$mem->connect('127.0.0.1',11211)){
    		die('连接失败');
    	}
    	// $mem->delete(6,0);
    	// $mem->delete('xiafenkey',0);
    	dd($mem->get($mem->get('xiafenkey')));
    }
}
