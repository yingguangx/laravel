<?php

namespace App\Http\Controllers\Staff;

use App\Models\StaffInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    //员工端用户登录
    public function login()
    {
        return view('staff/login/login');
    }

    //验证员工端登录
    public function dologin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $obj = StaffInfo::where('email', $email)->first();
        $pass = $this->decrypt($obj['password']);

        if ($pass == $password) {
            session(['staff_id' => $obj['id']]);
            session(['staff_role' => $obj['role']]);
            return redirect()->route('staff.index');
        } else {
            return redirect()->route('staff.login');
        }
    }

    //员工端首页
    public function staffIndex()
    {
        return view('staff/login/index');
    }

    //密码加密
    public static function encrypt($id)
    {
        $id=serialize($id);
        $key="1112121212121212121212";
        $data['iv']=base64_encode(substr('fdakinel;injajdji',0,16));
        $data['value']=openssl_encrypt($id, 'AES-256-CBC',$key,0,base64_decode($data['iv']));
        $encrypt=base64_encode(json_encode($data));
        return $encrypt;
    }

    //密码解密
    public static function decrypt($encrypt)
    {
        $key = '1112121212121212121212';//解密钥匙
        $encrypt = json_decode(base64_decode($encrypt), true);
        $iv = base64_decode($encrypt['iv']);
        $decrypt = openssl_decrypt($encrypt['value'], 'AES-256-CBC', $key, 0, $iv);
        $id = unserialize($decrypt);
        if($id){
            return $id;
        }else{
            return 0;
        }
    }

    //登出
    public function loginOut(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('staff.login');
    }
}
