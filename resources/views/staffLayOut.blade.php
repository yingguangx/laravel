<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>集结号有限公司管理后台</title>

    <link rel="stylesheet" href="{{ URL::asset('css/index.css') }}" type="text/css" media="screen" />
    <link href="{{URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{URL::asset('/layui/css/layui.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{URL::asset('css/weui.min.css')}}">


    <script type="text/javascript" src="{{ URL::asset('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/tendina.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/common.js') }}"></script>
    <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('js/jquery-weui.js')}}"></script>
    <style>body{font-size:14px;}</style>
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
            <a href="{{ URL::asset('staff/turnOver') }}"> <i class="glyph-icon  icon-reorder"></i>经营状况</a>
        </li>
        @else
        @endif
        <li class="childUlLi">
            <a href="#"  target="menuFrame"> <i class="glyph-icon icon-reorder"></i>订单管理<span style="color:red;" class="ordernum"></span></a>
            <ul>
                <li><a href="{{ URL('staff/shafenOrderIndex') }}"><i class="glyph-icon icon-chevron-right"></i>上分订单</a></li>
                <li><a href="{{ URL('staff/xiafenOrderIndex') }}"><i class="glyph-icon icon-chevron-right"></i>下分订单<span style="color:red;" class="xiafenorder"></span></a></li>
                <li><a href="{{ URL('staff/jifenOrderIndex') }}"><i class="glyph-icon icon-chevron-right"></i>积分订单</a></li>
                <li><a href="{{ URL('staff/balanceIndex') }}"><i class="glyph-icon icon-chevron-right"></i>余额兑换<span style="color:red;" class="moneychangeorder"></span></a></li>
            </ul>
        </li>
         <li class="childUlLi">
            <a href="{{ URL('staff/balance_into') }}"> <i class="glyph-icon  icon-reorder"></i>余额充值</a>
        </li>
        <li class="childUlLi">
            <a href="#" target="menuFrame"> <i class="glyph-icon icon-reorder"></i>系统设置</a>
            <ul>
                <li><a href="{{ URL('staff/gameSetting') }}"><i class="glyph-icon icon-chevron-right"></i>游戏类目设置</a></li>
                <li><a href="{{URL('staff/coupons/index')}}"><i class="glyph-icon icon-chevron-right"></i>优惠券设置</a></li>
                <li><a href="{{ URL('staff/wheel/index') }}"><i class="glyph-icon icon-chevron-right"></i>大转盘设置</a></li>
                <li><a href="{{ URL::asset('staff/integrationSetting') }}"><i class="glyph-icon icon-chevron-right"></i>积分设置</a></li>
            </ul>
        </li>
        <li class="childUlLi">
            <a href="#" target="menuFrame"> <i class="glyph-icon icon-reorder"></i>用户管理</a>
            <ul>
                <li><a href="{{ URL('staff/user') }}"><i class="glyph-icon icon-chevron-right"></i>用户列表</a></li>
            </ul>
        </li>
        @if(session('staff_role') == 1)
        <li class="childUlLi">
            <a href="#"> <i class="glyph-icon  icon-reorder"></i>员工管理</a>
            <ul>
                <li><a href="{{ URL::asset('staff/staffList') }}"><i class="glyph-icon icon-chevron-right"></i>员工列表</a></li>
            </ul>
        </li>
        @else
        @endif
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
<script>
$('<audio id="chatAudio"><source src="{{URL::asset("audio/song.mp3")}}" type="audio/mpeg"></audio>').appendTo('body');
       function getmessage(){
           $.ajax({
               url: "/staff/getmessage",
               type: "POST",
               dataType: "json",
               headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               success: function (data) {
               
                        // $('.ordernum').text('');
                        $('.xiafenorder').text('');
                        $('.xiafenorderappend').html('');
                        $('.moneychangeorder').text('');
                        $('.moneychangeorderappend').html('');
                            var num = 0;
                            var num2 = 0;
                       if (data.xiafenorders.length != 0) {
                            var html="";
                            $.each(data.xiafenorders, function (i, item) {
                                console.log(item.user_name);
                                num++;
                                html = html+"<tr><td>"+item.user_name+"</td><td>"+item.game_name+"</td><td>"+item.money+"</td><td>"+item.txt+"</td><td>"+item.created_at+'</td><td><button onclick="xiafenok('+item.id+')">下分完成点击</button></td></tr>';
                            })
                           $('.xiafenorder').text('+'+num);
                           $('.xiafenorderappend').html(html);
                       }
                       if (data.moneychangenorders.length != 0) {
                        // console.log(data.moneychangenorders);
                        // return false;
                        
                            var html2="";
                            $.each(data.moneychangenorders, function (i, item) {
                                var gather_sort = item.gather_sort;
                                var money = item.money;
                                var nickName = item.nickName;
                                if (typeof(item.imgUrl) != 'undefined') {
                                    var imgUrl = item.imgUrl;
                                } else {
                                    var imgUrl = '';
                                }
                                 if (typeof(item.gather_account) != 'undefined') {
                                    var gather_account = item.gather_account;
                                } else {
                                    var gather_account = '';
                                }
                                 if (typeof(item.time) != 'undefined') {
                                    var time = item.time;
                                } else {
                                    var time = '';
                                }
                                 if (typeof(item.gather_name) != 'undefined') {
                                    var gather_name = item.gather_name;
                                } else {
                                    var gather_name = '';
                                }
                                num2++;
                                html2 = html2+"<tr><td>"+nickName+"</td><td>"+money+"</td><td>"+gather_sort+"</td><td>"+gather_account+"</td><td>"+gather_name+'</td><td>'+imgUrl+'</td><td>'+time+'</td><td><button onclick="moneychangeok('+item.id+')">下分完成点击</button></td></tr>';
                            })
                           $('.moneychangeorder').text('+'+num2);
                           $('.moneychangeorderappend').html(html2);
                       }
                            var ordernum_has = $('.ordernum').text();
                            // console.log(ordernum_has);
                            var num_all = num+num2;
                            if (ordernum_has != '') {
                                if (num_all > parseInt(ordernum_has)) {
                                     $('#chatAudio')[0].play();
                                }
                            }
                           $('.ordernum').text('+'+num_all);

                   }
           });
       }
//       setInterval(getmessage,2000);
</script>