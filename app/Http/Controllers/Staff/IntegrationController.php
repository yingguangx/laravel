<?php

namespace App\Http\Controllers\Staff;

use App\Models\IntegrationRule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IntegrationController extends Controller
{
    //积分设置
    public function IntegrationSetting()
    {
        $data = DB::table('integration_rule')
            ->select('limit_value', 'integration', 'start_value', 'get_value')
            ->where('id', 1)
            ->first();

        return view('staff/integration/index', ['data'=>$data]);
    }

    //添加积分规则
    public function addIntegration(Request $request)
    {
        $data = $request->all();
        $obj = new IntegrationRule();
        foreach ($data as $k=>$v) {
            $obj->$k = $v;
        }
        return response()->json($obj->save());
    }
    //修改积分设置
    public function editIntegration(Request $request)
    {
        $data = $request->all();
        $obj = IntegrationRule::find(1);
        foreach ($data as $k=>$v) {
            $obj->$k = $v;
        }
        return response()->json($obj->save());
    }
}
