<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Integration;
use App\Models\IntegrationRule;
use App\Models\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Memcache;


class ReChangeController extends Controller
{
    //上分充值页
    public function reChange()
    {
        $game = DB::table('game')
            ->where('status', 1)
            ->select('id', 'name')
            ->get();

        $rule = IntegrationRule::find(1);

        return view('reChange/reChange',[
            'game' => $game,
            'rule' => $rule
        ]);
    }

    //上分获取汇率
    public function getRate(Request $request)
    {
        $gameId = $request->input('game_id');
        $money = $request->input('money');
        $obj = DB::table('game')
            ->where('id', $gameId)
            ->where('status', 1)
            ->select('up_rate', 'name')
            ->first();
        $array = array();
        $array['rate'] = $obj->up_rate;
        $array['name'] = $obj->name;
        $array['value'] = $money*$obj->up_rate;

        $user = Auth::user()->toArray();
        $array['nickName'] = $user['nickName'];

        return response()->json($array);
    }

    //上分新订单
    public function newOrder(Request $request)
    {
        $data = $request->all();
        $user = Auth::user()->toArray();

        $id = $user['id'];
        $money = $data['money'];
        $data['user_id'] = $id;

        //获取用余额
        $balance = $user['money'];
        if ($data['money'] > $balance) {
            $arr = array();
            $arr['msg'] = false;
            return response()->json($arr);
        } else {
            $rule = IntegrationRule::find(1);

            $this::userAddIntegration($data['user_id'], $data['money'], $rule);

            $obj = new Order();
            foreach ($data as $k => $v) {
                $obj -> $k = $v;
            }
            $obj -> type = 1;
            $obj->save();
            $insertId = $obj -> id;
            $user = User::find($id);
            $user -> money = $user['money'] - $data['money'];
            $user -> save();

            //上分订单存入memcache
            $memArr = Array();
            $memArr['name'] = $user -> nickName;
            $memArr['type'] = $this::getGameName($data['game_id']);
            $memArr['money'] = $money;
            $memArr['value'] = $data['value'];
            $memArr['account'] = $obj->game_account;
            $memArr['time'] = date('Y-m-d H:i:s',time());
            $memArr['id'] = $insertId;
            $memArr = serialize($memArr);
            get_memcache('shangfenkey', $insertId, $memArr);

            $arr = array();
            $arr['msg'] = true;
            $arr['name'] = $this::getGameName($data['game_id']);
            $arr['number'] = $this::getGameNumber($data['game_id']);
            return response()->json($arr);
        }
    }

    //客户积分存储
    public static function userAddIntegration($user_id, $money, $obj)
    {
        $each = $obj['integration']/$obj['limit_value'];
        $integration = (float)$money*$each;

        $user = User::find($user_id);
        $user -> integration = $user['integration'] + $integration;
        $user -> save();
    }

    //获取游戏名称
    public static function getGameName($id)
    {
        $game = Game::find($id);
        return $game -> name;
    }

    //获取房间号
    public static function getGameNumber($id)
    {
        $game = Game::find($id);
        return $game -> up_game_room;
    }
}
