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
<div class="sel_type" style="margin-top: 30px">
    <div class="fl typeP">
        <p>选择游戏种类:</p>
    </div>
    <div class="fl typeSel">
        <select id="selType" name="selType" class="form-control">
            <option value="">请选择游戏种类</option>
            @foreach($game as $value)
                <option value="{{ $value->id }}"> {{ $value->name }}</option>
            @endforeach
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
<div class="sel_type" id="user_defined">
    <div class="fl typeP">
        <p>输入充值金额:</p>
    </div>
    <div class="fl typeSel">
        <input  id="inputDefined" type="text" class="form-input" placeholder="请输入金额">
    </div>
    <div class="clear"></div>
</div>

<!--充值列表-->
<div class="person_wallet_recharge">
    <div class="pic">
        <span>小提示: 每上分{{ $rule['limit_value'] }}元可获得{{ $rule['integration'] }}积分！！</span>
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
    //验证
    $('.botton').click(function () {
        var type = $('#selType').val();
        var gameAccount = $('#gameAccount').val();
        var inputDefined = $('#inputDefined').val();
        if (type == '') {
            layer.msg('请选择游戏种类！', {time:1500});
            return false;
        }
        if (gameAccount == '') {
            layer.msg('请输入上分游戏ID！', {time:1500});
            return false;
        }
        if (inputDefined == '') {
            layer.msg('请输入上分金额！', {time:1500});
            return false;
        }

        $.ajax({
            type:'post',
            dataType:'json',
            url:'/getRate',
            data:{
                'game_id':type,
                'money':inputDefined
            },
            success:function(data){
                if (data) {
                    var content =
                            '<div>'
                            +'<div class="fl" style="width: 40%;text-align: right;margin-left: 20px;"><span>客户姓名:</span></div>'
                            +'<div class="fl" style="width: 40%;text-align: left;margin-left: 10px;"><span>'+data['nickName']+'</span></div>'
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
                        btn: ['取消','确定'],
                        title: '上分详情'
                    }, function(){
                        layer.closeAll('dialog');
                    }, function(){
                        $.ajax({
                            url:'/newOrder',
                            type: 'post',
                            dataType: 'json',
                            data:{
                                game_account:gameAccount,
                                game_id:type,
                                money:inputDefined,
                                value:data['value'],
                            },
                            success:function(data){
                                if (data['msg']) {
                                    if (data['number'] == null || data['number'] == '') {
                                        var content = '上分成功,祝您游戏愉快！'
                                    } else {
                                        var content = '上分成功,'+data['name']+'游戏房间号为'+data['number']+',祝您游戏愉快！'
                                    }

                                    layer.confirm(content, {
                                        btn: ['确定'],
                                        icon: 6
                                    }, function(){
                                        window.location.reload();
                                    });
                                } else {
                                    layer.confirm('上分失败,请核实账户余额！', {
                                        btn: ['确定'],
                                        icon: 5
                                    }, function(index){
                                        layer.close(index);
                                    });
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
