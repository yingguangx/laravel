<?php

namespace App\Http\Controllers\Staff;

use App\Models\Customer;
use App\Models\Finance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Staff;
use DB,Session;
use Illuminate\Pagination\LengthAwarePaginator;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    //这几个账户是自己用的或者是测试账户，不计入首页的各项统计
    //protected $account_array =array(800001,800066,800010,802449);
    public function __construct()
    {
        //测试用户查询
        // $account_array =Customer::where("is_real",0)->pluck('number');
        // $this->account_array=$account_array;
    }

    public function index()
    {
        // $staffInfo = Staff::where('id',session('staff_id'))->first();
        return view('staff.login.index');
    }
}
