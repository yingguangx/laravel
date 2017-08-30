@extends('coupons.main')


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
            width:33.33vw;
        }
        .coupons-div li img,.coupons-div li span{
            display:inline-block;
        }
        .coupons-div li img{
            margin-right:5px;
        }
        .coupons-div li span{
            padding: 5px;
        }
        .coupons-div li.active{
            color:#A2C468;
            border-bottom:3px solid #A2C468;
        }
    </style>
@endsection
{{--主题内容--}}
@section('content')
    <ul class="coupons-div">
        <li class="clearfix active">
            <img class="fl " src="{{URL::asset('image/coupons/award_bg0.png')}}" alt="">
            <span class="fl">兑奖券</span>
            <span class="fl">(&nbsp;0&nbsp;)</span>
        </li>
    </ul>
    <ul class="coupons-card-div">
        <li>
            卡券1
        </li>
        <li>
            卡券2
        </li>
        <li>
            卡券3
        </li>
    </ul>
@endsection



{{--js代码--}}
@section('inner_script')
    <script>
        $(function(){
            $('.coupons-div li.active img').attr('src',"<?php echo URL::asset('image/coupons/award_bg1.png')?>");
        })
    </script>
@endsection