<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Memcache;
use Illuminate\Support\Facades\Auth;

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
    	if ($mem->get('xiafenkey') != false && $mem->get('xiafenkey') != array()) {
    		$xiafenorders = $mem->get($mem->get('xiafenkey'));
           foreach ($xiafenorders as $k => &$v) {
                $v = unserialize($v);
           }
    	} else {
    		$xiafenorders = [];
    	}
        if ($mem->get('moneyChangekey') != false && $mem->get('moneyChangekey') != array()) {
            $moneychangenorders = $mem->get($mem->get('moneyChangekey'));
            foreach ($moneychangenorders as $k => &$v) {
                $v = unserialize($v);
           }
        } else {
            $moneychangenorders = [];
        }
         if ($mem->get('shangfenkey') != false && $mem->get('shangfenkey') != array()) {
            $shangfenorders = $mem->get($mem->get('shangfenkey'));
            foreach ($shangfenorders as $k => &$v) {
                $v = unserialize($v);
           }
        } else {
            $shangfenorders = [];
        }
    	return response()->json(['xiafenorders'=>$xiafenorders,'moneychangenorders'=>$moneychangenorders,'shangfenorders'=>$shangfenorders]);
    }

    public function xiafenOrderIndex()
    {
        $order = DB::table('order as o')
        ->leftJoin('game as g','o.game_id','=','g.id')
        ->leftJoin('users as u','o.user_id','=','u.id')
        ->select('o.money','o.value','o.created_at','u.name as uname','g.name as gname','o.id','o.xiafen_picture')
        ->where(['o.status'=>1,'type'=>2])
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
    	DB::table('game')->insert( ['name' =>$all['game_name'], 'hhwx_rate' => $all['down_rate'],'business_id' => $all['business_id'], 'up_rate' => $all['up_rate'],'created_at'=>date('Y-m-d H:i:s',time()),'updated_at'=>date('Y-m-d H:i:s',time()),'cost_price'=>$all['cost_price']]);
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
    	DB::table('game')->where('id',$all['gameid'])->update(['name' => $all['game_name_up'],'up_rate' => $all['up_rate_up'],'hhwx_rate' => $all['down_rate_up'],'business_id' => $all['business_id_up'],'cost_price'=>$all['price_cost_up']]);
    	return Redirect::route('staff.gameSetting');
    }

    public function shafenOrderIndex()
    {   

         $order = DB::table('order as o')
        ->leftJoin('game as g','o.game_id','=','g.id')
        ->leftJoin('users as u','o.user_id','=','u.id')
        ->select('o.money','o.value','o.created_at','u.name as uname','g.name as gname','o.id','o.game_account')
        ->where(['o.status'=>1,'type'=>1])
        ->get();
        return view('staff.order.shafen',['orders'=>$order]);
    }

    public function jifenOrderIndex()
    {
        return view('staff.order.jifen');
    }

    public function balanceIndex()
    {
        $order = DB::table('money_change')
        ->where('status',1)
        ->get();
        return view('staff.order.balance',['orders'=>$order]);
    }

    public function xiafenok(Request $request)
    {
        $id = $request->input('id');
        $mem = new Memcache;
        if (!$mem->connect('127.0.0.1',11211)){
            die('连接失败');
        }
        $bool = $mem->delete('xiafenkey'.$id,0);
        $xiafenkey = $mem->get('xiafenkey');
        array_splice($xiafenkey,array_search('xiafenkey'.$id,$xiafenkey),1);
        $mem->set("xiafenkey",$xiafenkey,MEMCACHE_COMPRESSED,0);
        // unset($xiafenkey[]);
        $bool2 = DB::table('order')->where('id',$id)->update(['status'=>0]);
        return response()->json(['result'=>true]);
    }
     public function shangfenok(Request $request)
    {
        $id = $request->input('id');
        $mem = new Memcache;
        if (!$mem->connect('127.0.0.1',11211)){
            die('连接失败');
        }
        $bool = $mem->delete('shangfenkey'.$id,0);
        $shangfenkey = $mem->get('shangfenkey');
        array_splice($shangfenkey,array_search('shangfenkey'.$id,$shangfenkey),1);
        $mem->set("shangfenkey",$shangfenkey,MEMCACHE_COMPRESSED,0);
        // unset($xiafenkey[]);
        $bool2 = DB::table('order')->where('id',$id)->update(['status'=>0]);
        return response()->json(['result'=>true]);
    }

    public function moneychangeok(Request $request)
    {
        $id = $request->input('id'); 
        $mem = new Memcache;
        if (!$mem->connect('127.0.0.1',11211)){
            die('连接失败');
        }
        $bool = $mem->delete('moneyChange'.$id,0);
        $moneyChangekey = $mem->get('moneyChangekey');
        array_splice($moneyChangekey,array_search('moneyChange'.$id,$moneyChangekey),1);
        $mem->set("moneyChangekey",$moneyChangekey,MEMCACHE_COMPRESSED,0);
        
        $bool2 = DB::table('money_change')->where('id',$id)->update(['status'=>0]);
        return response()->json(['result'=>true]);
    }

    public function balance_into()
    {
        return view('staff.order.balance_into');
    }

    public function money_insert(Request $request)
    {
        $all = $request->all();
        $user = Auth::user()->toArray();
        $money_before_arr = DB::table('users')->where('key',$all['key'])->select('money')->first();
        if ($money_before_arr != null) {
            $money_before =  $money_before_arr->money;
        } else {
            return response()->json(['result'=>false,'error'=>'交易码不存在']); 
        }
        $money_now = (int)$money_before+(int)$all['money'];
        DB::table('money_insert')->insert(['money'=>$all['money'],'user_id'=>$user['id'],'created_at'=>date('Y-m-d H:i:s',time()),'updated_at'=>date('Y-m-d H:i:s',time())]);
        $bool = DB::table('users')->where('key',$all['key'])->update(['money'=> $money_now]);
        if ($bool) {
            return response()->json(['result'=>true]); 
        } else {
            return response()->json(['result'=>false,'error'=>'意外错误']); 
        }
    }
}
