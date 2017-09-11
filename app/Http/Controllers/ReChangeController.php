<?php

namespace App\Http\Controllers;

use App\Models\Integration;
use App\Models\IntegrationRule;
use App\Models\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            return response()->json(false);
        } else {
            $rule = IntegrationRule::find(1);
            if ($money >= $rule['limit_value']) {
                $this::userAddIntegration($data['user_id'], $data['money'], $rule);
            }

            $obj = new Order();
            foreach ($data as $k => $v) {
                $obj -> $k = $v;
            }
            $obj -> type = 1;

            $user = User::find($id);
            $user -> money = $user['money'] - $data['money'];
            $user -> save();
            return response()->json($obj->save());
        }
    }

    //客户积分存储
    public static function userAddIntegration($user_id, $money, $obj)
    {
        $multiple = (int)floor($money/$obj['limit_value']);
        $integration = $multiple*$obj['integration'];

        $user = User::find($user_id);
        $user -> integration = $user['integration'] + $integration;
        $user -> save();
    }
}
