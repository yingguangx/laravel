<?php
/**
 * Created by PhpStorm.
 * User: chindor
 * Date: 2017/8/30
 * Time: 19:00
 */

namespace App\Http\Controllers;

/**卡券 大转盘控制器
 * Class CouponsController
 * @package App\Http\Controllers
 */
class CouponsController
{
    public function index()
    {
        return view('coupons.card_index');
    }
    public function show()
    {
        return view('coupons.wheel');
    }

}