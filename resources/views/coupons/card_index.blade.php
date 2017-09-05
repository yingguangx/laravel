@extends('coupons.main')
@section('title','我的卡券')

@section('style')
    <style>
        *{
            margin:0;
            padding:0;
        }
        li{
            list-style: none;
        }
        .fl{
            float:left;
        }
        .fr{
            float:right;
        }
        .clearfix:after{content:".";display:block;height:0;clear:both;visibility:hidden}
        .clearfix{*+height:1%;}
        .coupons-div li{
            padding:10px 5px 10px 10px;
            width: 44vw;
            display: flex;
            float:left;
            justify-content: center;
            align-items: center;
        }
        .coupons-div li img,.coupons-div li span{
            display:inline-block;
        }
        .coupons-div li img{
            width: 18px;
            margin-right: 5px;
        }
        .coupons-div li span{
            padding: 0px;
            padding-top: 3px;
            font-size: 12px;
            margin-right: 3px;
        }
        .coupons-div li.active{
            color:#366FE5;
            border-bottom:3px solid #366FE5;
        }
        ul.cer_card li {
            padding: 0px 10%;
            margin-bottom: 19px;
        }

        ul.cer_card li:nth-of-type(1){
            margin-top:30px;
        }

        ul.cer_card li .invalid{
            background: url({{URL::asset('image/coupons/invalid_card.png')}});
            background-position: -1px 0;
        }
        ul.cer_card li .ygq{
            background: url({{URL::asset('image/coupons/ygq.png')}}) no-repeat 100% 100%;
            position: absolute;
            width:100%;
            /*width: 251px;*/
            height: 151px;
            position: absolute;
            z-index: 2;
        }
        ul.cer_card li .jxq {
            background: url({{URL::asset('image/coupons/card.png')}});
            background-position: -1px 0;
        }
        ul.cer_card li .img {
            background: url({{URL::asset('image/coupons/card.png')}});
            /*width: 251px;*/
            /*height: 151px;*/
            /* color: #FFF; */
            background-position: -1px 0;
        }
        ul.cer_card li>div{
            position:relative;
        }
        .f14 {
            font-size: 14px;
        }
        .quanName {
            padding-top: 18px;
            font-size: 16px;
            padding-left: 30px;
            position: relative;
            z-index: 1;
            opacity: 0.9;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .money {
            padding-top: 15px;
            padding-left: 30px;
        }
        .price {
            /*font-size: 42px;*/
            margin-right: 2px;
            font-family: "Tahoma";
        }
        .f24 {
            font-size: 24px;
        }
       .yxsj {
            color: #ffffff;
            opacity: 0.9;
            padding-left: 30px;
            font-size: 13px;padding-bottom: 7px;
        }
        .hide{
            display: none;
        }
        .weui-dialog{
            opacity: 1;
            visibility: visible;
            -webkit-transform: scale(2) translate(-50%, -50%)!important;
            transform: scale(2) translate(-50%, -50%) !important;
        }
    </style>
@endsection
{{--主题内容--}}
@section('content')
    <ul class="coupons-div clearfix">
        <li class="clearfix active">
            <img class="fl " src="{{URL::asset('image/coupons/award_bg0.png')}}" alt="">
            <span class="fl">未使用</span>
            <span class="fl">(&nbsp;0&nbsp;)</span>
        </li>
        <li class="clearfix">
            <img class="fl " src="{{URL::asset('image/coupons/award_bg0.png')}}" alt="">
            <span class="fl">已过期</span>
            <span class="fl">(&nbsp;0&nbsp;)</span>
        </li>
    </ul>
    <ul class="coupons-card-div">
        <ul class="cer_card clearfix" id="tabs_cont">
            <li>
                <div class="img jxq">
                    <div class="">
                    </div>
                    <div class="f14 quanName" title="黄金福利券">黄金福利券</div>
                    <div class="money">

                        <span class="price">2</span><span class="f14">克</span>

                    </div>
                    <div class="yxsj">
                        08-30 15:19 至 09-06 15:19有效
                    </div>
                </div>
                {{--<div class="desc">--}}
                    {{--<div class="clearfix"><span class="gray tit">购买金额：</span><span class="gray">满15克可用</span></div>--}}
                    {{--<div class="clearfix"><span class="gray tit">购买期限：</span><span class="gray">满170天可用</span></div>--}}
                {{--</div>--}}
            </li>
            <li>
                <div class="img jxq">
                    <div class="">
                    </div>
                    <div class="f14 quanName" title="黄金福利券">黄金福利券</div>
                    <div class="money">

                        <span class="price">2</span><span class="f14">克</span>

                    </div>
                    <div class="yxsj">
                        08-30 15:19 至 09-06 15:19有效
                    </div>
                </div>
                {{--<div class="desc">--}}
                {{--<div class="clearfix"><span class="gray tit">购买金额：</span><span class="gray">满15克可用</span></div>--}}
                {{--<div class="clearfix"><span class="gray tit">购买期限：</span><span class="gray">满170天可用</span></div>--}}
                {{--</div>--}}
            </li>
            <li>
                <div class="invalid">
                    <div class="ygq">
                    </div>
                    <div class="f14 quanName" title="黄金福利券">黄金福利券</div>
                    <div class="money">

                        <span class="price">2</span><span class="f24">克</span>

                    </div>
                    <div class="yxsj">
                        08-30 15:19 至 09-06 15:19有效
                    </div>
                </div>
                {{--<div class="desc">--}}
                {{--<div class="clearfix"><span class="gray tit">购买金额：</span><span class="gray">满15克可用</span></div>--}}
                {{--<div class="clearfix"><span class="gray tit">购买期限：</span><span class="gray">满170天可用</span></div>--}}
                {{--</div>--}}
            </li>
            <li>
                <div class="img jxq">
                    <div class="">
                    </div>
                    <div class="f14 quanName" title="黄金福利券">黄金福利券</div>
                    <div class="money">

                        <span class="price">2</span><span class="f24">克</span>

                    </div>
                    <div class="yxsj">
                        08-30 15:19 至 09-06 15:19有效
                    </div>
                </div>
                {{--<div class="desc">--}}
                {{--<div class="clearfix"><span class="gray tit">购买金额：</span><span class="gray">满15克可用</span></div>--}}
                {{--<div class="clearfix"><span class="gray tit">购买期限：</span><span class="gray">满170天可用</span></div>--}}
                {{--</div>--}}
            </li>
            {{--<p class="j_tips gray">仅显示最近30天内的投资券</p></ul>--}}
    </ul>
        <ul class="cer_card clearfix hide" id="tabs_cont">
            <li>
                <div class="invalid">
                    <div class="ygq">
                    </div>
                    <div class="f14 quanName" title="黄金福利券">黄金福利券</div>
                    <div class="money">

                        <span class="price">2</span><span class="f24">克</span>

                    </div>
                    <div class="yxsj">
                        08-30 15:19 至 09-06 15:19有效
                    </div>
                </div>
                {{--<div class="desc">--}}
                {{--<div class="clearfix"><span class="gray tit">购买金额：</span><span class="gray">满15克可用</span></div>--}}
                {{--<div class="clearfix"><span class="gray tit">购买期限：</span><span class="gray">满170天可用</span></div>--}}
                {{--</div>--}}
            </li>
            <li>
                <div class="invalid">
                    <div class="ygq">
                    </div>
                    <div class="f14 quanName" title="黄金福利券">黄金福利券</div>
                    <div class="money">

                        <span class="price">2</span><span class="f24">克</span>

                    </div>
                    <div class="yxsj">
                        08-30 15:19 至 09-06 15:19有效
                    </div>
                </div>
                {{--<div class="desc">--}}
                {{--<div class="clearfix"><span class="gray tit">购买金额：</span><span class="gray">满15克可用</span></div>--}}
                {{--<div class="clearfix"><span class="gray tit">购买期限：</span><span class="gray">满170天可用</span></div>--}}
                {{--</div>--}}
            </li>
            <li>
                <div class="invalid">
                    <div class="ygq">
                    </div>
                    <div class="f14 quanName" title="黄金福利券">黄金福利券</div>
                    <div class="money">

                        <span class="price">2</span><span class="f24">克</span>

                    </div>
                    <div class="yxsj">
                        08-30 15:19 至 09-06 15:19有效
                    </div>
                </div>
                {{--<div class="desc">--}}
                {{--<div class="clearfix"><span class="gray tit">购买金额：</span><span class="gray">满15克可用</span></div>--}}
                {{--<div class="clearfix"><span class="gray tit">购买期限：</span><span class="gray">满170天可用</span></div>--}}
                {{--</div>--}}
            </li>
            <li>
                <div class="invalid">
                    <div class="ygq">
                    </div>
                    <div class="f14 quanName" title="黄金福利券">黄金福利券</div>
                    <div class="money">

                        <span class="price">2</span><span class="f24">克</span>

                    </div>
                    <div class="yxsj">
                        08-30 15:19 至 09-06 15:19有效
                    </div>
                </div>
                {{--<div class="desc">--}}
                {{--<div class="clearfix"><span class="gray tit">购买金额：</span><span class="gray">满15克可用</span></div>--}}
                {{--<div class="clearfix"><span class="gray tit">购买期限：</span><span class="gray">满170天可用</span></div>--}}
                {{--</div>--}}
            </li>
            <li>
                <div class="invalid">
                    <div class="ygq">
                    </div>
                    <div class="f14 quanName" title="黄金福利券">黄金福利券</div>
                    <div class="money">

                        <span class="price">2</span><span class="f24">克</span>

                    </div>
                    <div class="yxsj">
                        08-30 15:19 至 09-06 15:19有效
                    </div>
                </div>
                {{--<div class="desc">--}}
                {{--<div class="clearfix"><span class="gray tit">购买金额：</span><span class="gray">满15克可用</span></div>--}}
                {{--<div class="clearfix"><span class="gray tit">购买期限：</span><span class="gray">满170天可用</span></div>--}}
                {{--</div>--}}
            </li>
            {{--<p class="j_tips gray">仅显示最近30天内的投资券</p></ul>--}}
        </ul>
    </ul>
@endsection



{{--js代码--}}
@section('inner_script')
    <script>
        $(function(){
            $('.coupons-div li.active img').attr('src',"<?php echo URL::asset('image/coupons/award_bg1.png')?>");
            $('.coupons-div li').click(function(){
                var index = $('.coupons-div li').index($(this));
                $(this).siblings().removeClass('active').end().addClass('active');
                $('.cer_card').addClass('hide').eq(index).removeClass('hide');
            })
        })
    </script>
@endsection