<?php

namespace App\Http\Controllers;

use Illuminate\Cache\MemcacheConnector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session,Redirect,Excel,Cache,URL;
use Memcache;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ToolController;

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
		    ['game_id' => $all['play_sort'], 'game_account' => $all['play_id'],'value'=>$all['txt'],'money'=>$money,'user_id'=>1,'created_at'=>date('Y-m-d H:i:s',time()),'type'=>2]
		);
        $game_name = DB::table('game')->where('id',$all['play_sort'])->pluck('name')->toArray()[0];
        $user_name = DB::table('users')->where('id',1)->pluck('name')->toArray()[0];
    	if ($mem->get('xiafenkey') == false){
    		$mem->set('xiafenkey', ["xiafenkey".$id],MEMCACHE_COMPRESSED,0);
    	} else {
    		$arr = $mem->get('xiafenkey');
    		$arr[] = "xiafenkey".$id;
    		$mem->set('xiafenkey', $arr,MEMCACHE_COMPRESSED,0);
    	}
        $all['money'] = $money;
        $all['created_at'] = date('Y-m-d H:i:s',time());
        $all['xiafenmark'] = $all['hhwx_rate']*$money;
        $all['game_name'] = $game_name;
        $all['user_name'] = $user_name;
    	$all['id'] = $id;
        $str_arr = serialize($all);
    	$bool = $mem->set("xiafenkey".$id,$str_arr,MEMCACHE_COMPRESSED,0);
    	return response()->json(['result1'=>true]);
    }

    public function test()
    {
    	$mem = new Memcache;
    	if (!$mem->connect('127.0.0.1',11211)){
    		die('连接失败');
    	}
        //   $mem->set('a11','1',MEMCACHE_COMPRESSED,0);
        // $mem->set('a22',['11','22','33'],MEMCACHE_COMPRESSED,0);
         // dd($mem->get('moneyChangekey'));
        // dd($mem->get('moneyChangekey')); 
        // dd($mem->get('xiafenkey41')); 
        // $mem = $mem->set('xiafenkey',['xiafenkey40','xiafenkey41']);
        // dd($mem->get($mem->get('shangfenkey')));
        dd($mem->get('shangfenkey'));
    	// dd($mem->get('aa1'));
        // $mem->delete('shangfenkey',0);
        // $mem->delete('shangfenkey63',0); 
        // $mem->delete('shangfenkey64',0); 
    }
    public function test2()
    {
        $mem = new Memcache;
        if (!$mem->connect('127.0.0.1',11211)){
            die('连接失败');
        }
        serialize([11,22]);
     
    }
}
