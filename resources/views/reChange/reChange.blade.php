<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <link rel="stylesheet" href="{{ asset('css/new_file.css') }}" />
    <script type="text/javascript" src="{{ asset('js/jquery-1.8.2.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('js/new_file.js') }}" ></script>
    <link rel="stylesheet" href="{{ asset('css/layer.css') }}" />
    <script type="text/javascript" src="{{ asset('js/layer.js') }}" ></script>
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
        <input type="text" class="form-input" placeholder="请输入游戏ID">
    </div>
    <div class="clear"></div>
</div>
<!--自定义金额-->
<div class="sel_type hide" id="user_defined">
    <div class="fl typeP">
        <p>自定义充值:</p>
    </div>
    <div class="fl typeSel">
        <input type="text" class="form-input" placeholder="请输入金额">
    </div>
    <div class="clear"></div>
</div>

<!--充值列表-->
<div class="person_wallet_recharge">
    <ul class="ul">
        <li>
            <h2 class="selInput">500</h2>
            <div class="sel" style=""></div>
        </li>
        <li>
            <h2 class="selInput">800</h2>
            <div class="sel" style=""></div>
        </li>
        <li>
            <h2 class="selInput">1200</h2>
            <div class="sel" style=""></div>
        </li>
        <li>
            <h2 class="selInput">2000</h2>
            <div class="sel" style=""></div>
        </li>
        <li>
            <h2 class="selInput">3000</h2>
            <div class="sel" style=""></div>
        </li>
        <li>
            <h2 onclick="userDefined()">自定义</h2>
            <div class="" style="" ></div>
        </li>
        <div style="clear: both;"></div>
    </ul>
    <div class="pic">金额：<input type="text" placeholder="金额必须为100以上" id="txt" /></div>
    <div class="botton">我要充值</div>
    <div class="agreement"><p>点击我要充值，即您已经表示同意<a>《充返活动协议》</a></p></div>
    <div class="f-overlay"></div>

    <!--支付选择-->
    <div class="addvideo" style="display: none;">
        <h3>本次充值<span>2000</span>元</h3>
        <ul>
            <li><a>微信支付</a></li>
            <li><a>支付宝支付</a></li>
            <li class="cal">取消</li>
        </ul>
    </div>
</div>
</body>
<script>
    function userDefined() {
        $('#user_defined').show();
    }

    $('.selInput').click(function () {
        $('#user_defined').hide();
    })
</script>
</html>