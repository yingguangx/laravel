<?php

namespace App\Http\Controllers\Staff;

use App\Models\userPayCode;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Memcache;

class UserController extends Controller
{

    public function index()
    {
        return view('staff.user.index');
    }

    public function apiGetUser(Request $request)
    {
        $page = $request->input('page');
        $limit = $request->input('limit');
        $page = ($page - 1)*$limit;
        $json = array();
        $count = User::count();
        $users = DB::table('users')->select('id','name','money','nickName','district','city','key','points','headImgUrl','status','created_at')->skip($page)->take($limit)->get();
        $json['code'] = 0;
        $json['msg'] = "";
        $json['count'] = $count;
        $json['data'] = $users;
        echo \GuzzleHttp\json_encode($json);
    }
    public function apiGetWechatCode(Request $request)
    {
        $user_id = $request->input('user_id');
        $path = userPayCode::where('user_id',$user_id)->where('type',1)->orderBy('created_at','desc')->first()->imgUrl;
        $path = storage_path().$path;
        return response()->file($path);

    }
    public function apiGetZtbCode(Request $request)
    {
        $user_id = $request->input('user_id');
        $path = userPayCode::where('user_id',$user_id)->where('type',1)->orderBy('created_at','desc')->first()->imgUrl;
        $path = storage_path().$path;
        return response()->file($path);

    }
}
