<?php

namespace App\Http\Controllers;

use App\Helpers\MyWoker;
use Illuminate\Cache\MemcacheConnector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session,Redirect,Excel,Cache,URL;
use Memcache;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ToolController;
use Illuminate\Support\Facades\Auth;

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
    	 $games = DB::table('game')->select('id','hhwx_rate','business_id','name','up_game_room','down_game_room')->get()->toArray();
         // dd($games);
    	 $arr1 = [];
    	 foreach ($games as $key => $game) {
    	 	$arr1[$game->id]['hhwx_rate'] = $game->hhwx_rate;
    	 	$arr1[$game->id]['business_id'] = $game->business_id;
    	 	$arr1[$game->id]['name'] = $game->name;
            if ($game->down_game_room != null ) {
                $arr1[$game->id]['down_game_room'] = $game->down_game_room;
            }
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
        $user = Auth::user()->toArray();
    	$money = (int)($all['txt']/$all['hhwx_rate']);
    	$money = round($money);
    	$id = DB::table('order')->insertGetId(
		    ['game_id' => $all['play_sort'], 'game_account' => $all['play_id'],'value'=>$all['txt'],'money'=>$money,'xiafen_picture'=>$all['file_path'],'user_id'=>$user['id'],'created_at'=>date('Y-m-d H:i:s',time()),'type'=>2]
		);
        $game_name = DB::table('game')->where('id',$all['play_sort'])->pluck('name')->toArray()[0];
        $user_name = DB::table('users')->where('id',$user['id'])->pluck('name')->toArray()[0];
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
        $all['path'] = $all['file_path'];
    	$all['id'] = $id;
        $str_arr = serialize($all);
    	$bool = $mem->set("xiafenkey".$id,$str_arr,MEMCACHE_COMPRESSED,0);
    	return response()->json(['result1'=>true]);
    }

    /**文件上传
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadFile(Request $request)
    {
        $path = $request->file('file')->store('capture');
        $arr = explode('/',$path);
        $file_name = array_pop($arr);
        return MyWoker::jsonSuccess($file_name,'','上传成功');
    }

    public function test()
    {
    	 $imgUrl_arr = DB::table('user_pay_codes')->where('user_id',53)->pluck('imgUrl','type');
         dd($imgUrl_arr);
    }
    public function test2()
    {
        $mem = new Memcache;
        if (!$mem->connect('127.0.0.1',11211)){
            die('连接失败');
        }
        // $mem->set("aa",'hehe',MEMCACHE_COMPRESSED,0);
        dd($mem->get('shangfenkey'));
     
    }
}
