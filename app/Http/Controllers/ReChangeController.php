<?php

namespace App\Http\Controllers;

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
        $obj = DB::table('exchange_rate as er')
            ->leftjoin('game as g', 'g.id', '=', 'er.game_id')
            ->where('er.game_id', $gameId)
            ->where('er.status', 1)
            ->select('er.rate', 'g.name')
            ->first();
        $array = array();
        $array['rate'] = $obj->rate;
        $array['name'] = $obj->name;
        $array['value'] = $money*$obj->rate;

        return response()->json($array);
    }

    public function newOrder(Request $request)
    {
        $data = $request->all();

        $obj = new Order();
        foreach ($data as $k => $v) {
            $obj -> $k = $v;
        }

        return response()->json($obj->save());
    }
}
