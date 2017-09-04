<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>集结号有限公司管理后台</title>

    <link rel="stylesheet" href="{{ URL::asset('css/index.css') }}" type="text/css" media="screen" />
    <link href="{{URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <script type="text/javascript" src="{{ URL::asset('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/tendina.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/common.js') }}"></script>
    @yield('style')
</head>
<body>
<!--顶部-->
<div class="layout_top_header">
    <div style="float: left"><span style="font-size: 16px;line-height: 45px;padding-left: 20px;color: #8d8d8d">集结号管理后台</span></div>
    <div id="ad_setting" class="ad_setting">
        <a class="ad_setting_a" href="javascript:; ">
            <i class="icon-user glyph-icon" style="font-size: 20px"></i>
            <span>
                @if(session('staff_role') == 1)
                    超级管理员
                @else
                    管理员
                @endif
            </span>
            <i class="icon-chevron-down glyph-icon"></i>
        </a>
        <ul class="dropdown-menu-uu" style="display: none" id="ad_setting_ul">
            <li class="ad_setting_ul_li"> <a href="javascript:;"><i class="icon-cog glyph-icon"></i>设置</a> </li>
            <li class="ad_setting_ul_li"> <a href="{{ URL::route('staff.loginOut') }}"><i class="icon-signout glyph-icon"></i> <span class="font-bold">退出</span> </a> </li>
        </ul>
    </div>
</div>
<!--顶部结束-->
<!--菜单-->
<div class="layout_left_menu">
    <ul id="menu">
        <li class="childUlLi">
            <a href="#"><i class="glyph-icon icon-home"></i>首页</a>
        </li>

        @if(session('staff_role') == 1)
        <li class="childUlLi">
            <a href="#"> <i class="glyph-icon  icon-reorder"></i>经营状况</a>
        </li>
        @else
        @endif
        <li class="childUlLi">
            <a href="#"  target="menuFrame"> <i class="glyph-icon icon-reorder"></i>订单管理</a>
            <ul>
                <li><a href="#"><i class="glyph-icon icon-chevron-right"></i>上分订单</a></li>
                <li><a href="#"><i class="glyph-icon icon-chevron-right"></i>下分订单</a></li>
                <li><a href="#"><i class="glyph-icon icon-chevron-right"></i>积分订单</a></li>
            </ul>
        </li>
        <li class="childUlLi">
            <a href="#" target="menuFrame"> <i class="glyph-icon icon-reorder"></i>系统设置</a>
            <ul>
                <li><a href="#"><i class="glyph-icon icon-chevron-right"></i>游戏类目设置</a></li>
                <li><a href="#"><i class="glyph-icon icon-chevron-right"></i>优惠券设置</a></li>
                <li><a href="#"><i class="glyph-icon icon-chevron-right"></i>大转盘设置</a></li>
                <li><a href="#"><i class="glyph-icon icon-chevron-right"></i>积分设置</a></li>
            </ul>
        </li>
        <li class="childUlLi">
            <a href="#"> <i class="glyph-icon  icon-location-arrow"></i>员工管理</a>
            <ul>
                <li><a href="#" target="menuFrame"><i class="glyph-icon icon-chevron-right"></i>员工列表</a></li>
            </ul>
        </li>
    </ul>
</div>
<!--菜单-->
<div id="layout_right_content" class="layout_right_content">
    @yield('content')
</div>
<div class="layout_footer">
    <p>Copyright © 集结号微信后台</p>
</div>
</body>
    @yield('jquery')
</html>