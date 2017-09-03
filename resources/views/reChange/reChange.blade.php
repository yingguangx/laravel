<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{ asset('css/new_file.css') }}" />
    <script type="text/javascript" src="{{ asset('js/jquery-1.8.2.min.js') }}" ></script>
    <title>集结号上分充值</title>
</head>
<style>
    .layui-layer-btn0 {
        float: left;
    }
</style>
<body>
<!--头部  star-->
<header>
    <a href="javascript:history.go(-1);">
        <div class="_left"><img src="{{ asset('images/return.png') }}"></div>
        上分充值
    </a>
</header>
<!--头部 end-->
<div class="banner">
    <img src="{{ asset('images/banner.png') }}" width="100%" height="80%"/>
</div>

<!--选择种类-->
<div class="sel_type">
    <div class="fl typeP">
        <p>选择游戏种类:</p>
    </div>
    <div class="fl typeSel">
        <select id="selType" name="selType" class="form-control">
            <option value="">请选择游戏种类</option>
            <option value="1">集结号捕鱼</option>
            <option value="2">辰龙游戏</option>
            <option value="3">跑得快</option>
        </select>
    </div>
    <div class="clear"></div>
</div>

<div class="sel_type">
    <div class="fl typeP">
        <p>上分游戏账号:</p>
    </div>
    <div class="fl typeSel">
        <input id="gameAccount" type="text" class="form-input" placeholder="请输入游戏ID">
    </div>
    <div class="clear"></div>
</div>
<!--自定义金额-->
<div class="sel_type hide" id="user_defined">
    <div class="fl typeP">
        <p>自定义充值:</p>
    </div>
    <div class="fl typeSel">
        <input  id="inputDefined" type="text" class="form-input" placeholder="请输入金额">
    </div>
    <div class="clear"></div>
</div>

<!--充值列表-->
<div class="person_wallet_recharge">
    <ul class="ul">
        <li class="mark">
            <h2 class="selInput">100</h2>
            <div class="sel" style=""></div>
        </li>
        <li class="mark">
            <h2 class="selInput">200</h2>
            <div class="sel" style=""></div>
        </li>
        <li class="mark">
            <h2 class="selInput">300</h2>
            <div class="sel" style=""></div>
        </li>
        <li class="mark">
            <h2 class="selInput">400</h2>
            <div class="sel" style=""></div>
        </li>
        <li class="mark">
            <h2 class="selInput">500</h2>
            <div class="sel" style=""></div>
        </li>
        <li>
            <h2 onclick="userDefined()">自定义</h2>
            <div class="" style="" ></div>
        </li>
        <div style="clear: both;"></div>
    </ul>
    <div class="pic">
        <span>小提示: 每上分200可获得20积分！！</span>
    </div>
    <div class="botton">我要充值</div>
    <div class="agreement"><p>点击我要充值，即您已经表示同意<a>《充返活动协议》</a></p></div>
    <div class="f-overlay"></div>

</div>
</body>
<script type="text/javascript" src="{{asset('/js/layui/layui.js')}}"></script>
<script>
    //设置ajax头部
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
    });
    //初始化layui
    layui.use('layer',function(){
        window.layer = layui.layer;
    })
    //自定义金额
    function userDefined() {
        $('#user_defined').show();
        $('#user_defined').parent().removeClass("current");
    }
    //隐藏自定义金额
    $('.selInput').click(function () {
        $('#user_defined').hide();
        $('#inputDefined').val('');
    })
    //选择金额相关
    $(".person_wallet_recharge .ul li").click(function(e){
        $(this).addClass("current").siblings("li").removeClass("current");
        $(this).children(".sel").show(0).parent().siblings().children(".sel").hide(0);
    });

    //验证
    $('.botton').click(function () {
        var type = $('#selType').val();
        var gameAccount = $('#gameAccount').val();
        var inputDefined = $('#inputDefined').val();
        var inputSel = $('.current').children().eq(0).html();
        if (type == '') {
            layer.msg('请选择游戏种类！', {time:1500});
            return false;
        }
        if (gameAccount == '') {
            layer.msg('请输入上分游戏ID！', {time:1500});
            return false;
        }
        if (!$(".person_wallet_recharge .ul .mark").hasClass('current') && inputDefined == '') {
            layer.msg('请选择或者输入金额！', {time:1500});
            return false;
        }

        var money = '';

        if (inputDefined == '') {
            money = inputSel;
        } else {
            money = inputDefined;
        }

        $.ajax({
            type:'post',
            dataType:'json',
            url:'/getRate',
            data:{
                'game_id':type,
                'money':money
            },
            success:function(data){
                if (data) {
                    var content =
                            '<div>'
                            +'<div class="fl" style="width: 40%;text-align: right;margin-left: 20px;"><span>客户姓名:</span></div>'
                            +'<div class="fl" style="width: 40%;text-align: left;margin-left: 10px;"><span>胡老三</span></div>'
                            +'<div class="clear"></div>'
                            +'</div>'
                            +'<div>'
                            +'<div class="fl" style="width: 40%;text-align: right;margin-left: 20px;"><span>游戏类型:</span></div>'
                            +'<div class="fl" style="width: 40%;text-align: left;margin-left: 10px;"><span>'+data['name']+'</span></div>'
                            +'<div class="clear"></div>'
                            +'</div>'
                            +'<div>'
                            +'<div class="fl" style="width: 40%;text-align: right;margin-left: 20px;"><span>游戏账号:</span></div>'
                            +'<div class="fl" style="width: 40%;text-align: left;margin-left: 10px;"><span>'+gameAccount+'</span></div>'
                            +'<div class="clear"></div>'
                            +'</div>'
                            +'<div>'
                            +'<div class="fl" style="width: 40%;text-align: right;margin-left: 20px;"><span>当前汇率:</span></div>'
                            +'<div class="fl" style="width: 40%;text-align: left;margin-left: 10px;"><span>1：'+data['rate']+'</span></div>'
                            +'<div class="clear"></div>'
                            +'</div>'
                            +'<div>'
                            +'<div class="fl" style="width: 40%;text-align: right;margin-left: 20px;"><span>上分金额:</span></div>'
                            +'<div class="fl" style="width: 40%;text-align: left;margin-left: 10px;"><span>100</span></div>'
                            +'<div class="clear"></div>'
                            +'</div>'
                            +'<div>'
                            +'<div class="fl" style="width: 40%;text-align: right;margin-left: 20px;"><span>实际分值:</span></div>'
                            +'<div class="fl" style="width: 40%;text-align: left;margin-left: 10px;"><span>'+data['value']+'万   </span></div>'
                            +'<div class="clear"></div>'
                            +'</div>';

                    layer.confirm(content, {
                        btn: ['取消','确定']
                    }, function(){
                        layer.closeAll('dialog');
                    }, function(){
                        $.ajax({
                            url:'/newOrder',
                            type: 'post',
                            dataType: 'json',
                            data:{
                                user_id:1,
                                game_account:gameAccount,
                                game_id:type,
                                money:money,
                                value:data['value'],
                            },
                            success:function(data){
                                if (data) {
                                    layer.msg('下单成功!!工作人员正在上分,请稍等大约一分钟后,前往个人中心查看余额。');
                                }
                            }
                        })
                    });
                }
            }
        });
    })
</script>
</html>
