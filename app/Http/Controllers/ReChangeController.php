<?php

namespace App\Http\Controllers;

use App\Models\Integration;
use App\Models\IntegrationRule;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReChangeController extends Controller
{
    //上分充值页
    public function reChange()
    {
        return view('reChange/reChange');
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

        return response()->json($array);
    }

    //上分新订单
    public function newOrder(Request $request)
    {
        $data = $request->all();
        $money = $data['money'];

        $rule = IntegrationRule::find(1);
        if ($money >= $rule['limit_value']) {
            $this::userAddIntegration($data['user_id'], $data['money'], $rule);
        }
        $obj = new Order();
        foreach ($data as $k => $v) {
            $obj -> $k = $v;
        }

        return response()->json($obj->save());
    }

    //客户积分存储
    public static function userAddIntegration($user_id, $money, $obj)
    {
        $multiple = (int)floor($money/$obj['limit_value']);
        $integration = $multiple*$obj['integration'];

        $newObj = new Integration();
        $newObj -> user_id = $user_id;
        $newObj -> integration = $integration;

        $newObj -> save();
    }
}
