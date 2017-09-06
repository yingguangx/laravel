<?php

namespace App\Http\Controllers\Staff;

use App\Models\StaffInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Staff\LoginController;

class StaffController extends Controller
{
    //员工列表
    public function staffList()
    {
        $data = StaffInfo::where('role', 2)
            ->get()->toArray();
        return view('staff/staff/index',[
            'data' => $data
        ]);
    }

    //验证账号
    public function checkAccount(Request $request)
    {
        $account = $request->input('account');
        $data = DB::table('staff_info')->where('email', $account)->first();

        if ($data) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    //员工新增
    public function addAccount(Request $request)
    {
        $data = $request->all();
        $data['password'] = LoginController::encrypt($data['password']);

        $obj = new StaffInfo();
        foreach ($data as $k=>$v) {
            $obj -> $k = $v;
        }
        return response()->json($obj->save());
    }

    //删除员工
    public function delStaff(Request $request)
    {
        $id = $request->input('id');
        $obj = StaffInfo::find($id);

        return response()->json($obj->delete());
    }

    //修改员工信息
    public function editStaff(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        if ($data['password'] == '') {
            unset($data['password']);
            unset($data['id']);
        } else {
            $data['password'] = LoginController::encrypt($data['password']);
        }
        $obj = StaffInfo::find($id);

        foreach ($data as $k=>$v) {
            $obj -> $k = $v;
        }

        return response()->json($obj->save());
    }
}
