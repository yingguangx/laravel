@extends('coupons.main')
@section('title','我的卡券')
@push('css')
<link rel="stylesheet" href="{{URL::asset('css/weui.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/jquery-weui.css')}}">
@endpush

@push('scripts')
<script src="{{URL::asset('js/jquery-weui.js')}}"></script>
@endpush

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
        .coupons-div{
            position: fixed;
            z-index: 200;
            top: 0;
            background: white;
        }
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
        ul.cer_card{
            color:#fff;
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
            font-size: 13px;padding-bottom: 7px;
           padding-left: 30px;
           padding-bottom: 10px;
           padding-top: 10px;
        }
        .hide{
            display: none;
        }
        .im_use{
            position: absolute;
            /* left: 3px; */
            right: 5px;
            top: 7px;
            font-size: 14px;
            color: #f9f302;
            background: rgba(238, 70, 21, 1);
            z-index: 1;
        }
        .sel_type {
            width: 100%;
            height: auto;
            /*margin: 0 auto;*/
            margin-top: 10px;
        }
        .typeP {
            width: 41%;
            margin-top: 10px;
            font-size: 12px;
            text-align: left;
        }
        .typeSel {
            /* margin-left: 28px; */
            width: 59%;
        }
        .form-control {
            display: block;
            width: 100%;
            height: 34px;
            /*padding: 6px 12px;*/
            font-size: 12px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        }
        .form-input {
            background-color: #fafafa;
            color: #2F353F;
            font-size: 12px;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
            -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
            -moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
            border: 1px solid #eee;
            box-shadow: none;
            height: 36px;
            width: 90%;
            padding-left: 18px;
        }
        option, select{
            font-family: inherit;
            font-size: inherit;
            font-style: inherit;
            font-weight: inherit;
            outline: 0;
        }
        .weui-dialog.weui-dialog--visible{
            transform: scale(1) translate(-50%, -50%)!important;
        }
        .coupons-card-div{
            margin-top: 75px;
        }
    </style>
@endsection

{{--主题内容--}}
@section('content')
    <ul class="coupons-div clearfix">
        <header>
            <div class="rt-bk clearfix">
                <i class="bk"></i>
                <a href="javascript:window.history.go(-1)" style="font-size: 12px;
    color: black;">
                    返回
                </a>
            </div>
            <div class="top-name"><p>我的卡券</p></div>
        </header>
        <li class="clearfix active">
            <img class="fl " src="{{URL::asset('image/coupons/award_bg0.png')}}" alt="">
            <span class="fl">待使用</span>
            <span class="fl">(&nbsp;<span class="un_used_num">{{$coupon_list['un_used']['count']}}</span>&nbsp;)</span>
        </li>
        <li class="clearfix">
            <img class="fl " src="{{URL::asset('image/coupons/award_bg0.png')}}" alt="">
            <span class="fl">已过期</span>
            <span class="fl">(&nbsp;{{$coupon_list['used']['count']}}&nbsp;)</span>
        </li>
    </ul>
    <ul class="coupons-card-div">
            <ul class="cer_card clearfix un_expired" id="tabs_cont">
                @foreach($coupon_list['un_used']['list'] as $k => $v)
                <li data-code="{{$v['code']}}">
                    {{--过期后class变为invalid,没过期是img --}}
                    <div class="img jxq ">
                        {{--过期后加class ygq--}}
                        <div class="">
                        </div>
                        <div class="f14 quanName" title="{{$v['name']}}">{{$v['name']}}</div>
                        <div class="money">

                            {{--<span class="price">2</span><span class="f14">克</span>--}}

                        </div>
                        <div class="yxsj">
                            {{$v['time']}} 有效
                        </div>
                        {{--没过期--}}
                        <div class="im_use">
                            立<br/>即<br/>使<br/>用
                        </div>
                    </div>
                </li>
                @endforeach
        </ul>
        <ul class="cer_card clearfix hide expired" id="tabs_cont">
            @foreach($coupon_list['used']['list'] as $k => $v)
            <li>
                <div class="invalid">
                    <div class="ygq">
                    </div>
                    <div class="f14 quanName" title="{{$v['name']}}">{{$v['name']}}</div>
                    <div class="money">
                        {{--<span class="price">2</span><span class="f24">克</span>--}}
                    </div>
                    <div class="yxsj">
                        {{$v['time']}} 有效
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </ul>

    {{ csrf_field() }}
@endsection



{{--js代码--}}
@section('inner_script')
    <script>
        function closeModal(index)
        {
            $(".weui-mask--visible").eq(index).removeClass("weui-mask--visible").transitionEnd(function() {
                $(this).remove();
            });
            $(".weui-dialog--visible").eq(index).removeClass("weui-dialog--visible").transitionEnd(function() {
                $(this).remove();
            });
        }
        var modal_content = '<div class="sel_type clearfix">'+
                            '<div class="fl typeP">'+
                            '<p>选择游戏种类:</p>'+
                            '</div>'+
                            '<div class="fl typeSel">'+
                            '<select id="selType" name="game_id" class="form-control" onchange="">'+
                            '<option value="-1">请选择游戏种类</option>'+
                            "@foreach($game_list as $k => $v)"+
                            '<option value="{{$v['id']}}">{{$v['name']}}</option>'+
                            "@endforeach"+
                            '</select>'+
                            '</div>'+
                            '</div>'+
                            '<div class="sel_type clearfix">'+
                            '<div class="fl typeP">'+
                            '<p>输入游戏ID:</p>'+
                            '</div>'+
                            '<div class="fl typeSel">'+
                            '<input type="text" class="form-input" placeholder="请输入游戏ID" name="game_account">'+
                            '</div>'+
                            '<div class="clear"></div>'+
                            '</div>';
        $(function(){
            $('.coupons-div li.active img').attr('src',"<?php echo URL::asset('image/coupons/award_bg1.png')?>");
            $('.coupons-div li').click(function(){
                var index = $('.coupons-div li').index($(this));
                $(this).siblings().removeClass('active').end().addClass('active');
                $('.cer_card').addClass('hide').eq(index).removeClass('hide');
            })

            //点击使用卡券之后的事件
            $('.un_expired li').click(function(e){
                var that = $(this);
                var code = $(this).data('code');
                $.modal({
                    title: '使用卡券',
                    text: modal_content,
                    autoClose:false,
                    buttons: [
                        {
                            text: "确认使用", onClick: function(){
                               var msg = '';
                               //检查输入框和下拉框是否选择
                               if($('select[name="game_id"] option:selected').val() == -1){
                                   msg = '请选择游戏!';
                               }
                               if($('input[name="game_account"]').val() == ''){
                                   msg = '游戏账号不能为空!';
                               }

                               if(msg!=''){
                                   $.modal({
                                       autoClose:false,
                                       text:msg,
                                       buttons:[
                                           {text:'确定',onClick:function(){
                                               closeModal(1);
                                           }}
                                       ]
                                   });
                                   return false;
                               }

                               $.ajax({
                                   beforeSend:function(){
                                       $.showLoading();
                                   },
                                   type:'POST',
                                   async:true,
                                   data:{'_token':'{{csrf_token()}}',money:'卡券',value:code,game_id:$('select[name="game_id"] option:selected').val(),game_account:$('input[name="game_account"]').val()},
                                   url :'{{URL::to('/coupons/use_card')}}',
                                   success:function(data){
                                       $.hideLoading();
                                       closeModal(0);
                                       if(data.code==200){
                                           $('.un_used_num').html(parseInt($('.un_used_num').html())-1);
                                           that.fadeOut().remove();
                                           $('ul.cer_card li').eq(0).css('margin-top','30px');
                                       }
                                       $.alert(data.msg);
                                   }
                               })
                            }
                        },
                        {
                            text:'取消',
                            onClick:function(){
                                $.closeModal();
                            }
                        }
                    ]
                });
            })
        })
    </script>
@endsection