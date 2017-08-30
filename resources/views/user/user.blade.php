@extends('layouts.main')

@section('css')
<link rel="stylesheet" href="{{url(elixir("css/user.css"))}}" type="text/css"/>
@endsection

@section('content')
    <div id="_centent">
        <header>
            <div class="rt-bk">
                <i class="bk"></i>
                <p>返回</p>
            </div>
            <div class="top-name"><p>个人中心</p></div>
        </header>

        <div class="head">
            <div class="head-img">
                <img src="images/head-img.png">
            </div>
            <div class="head-dsb">
                <p class="dsb-name">user</p>
                <p class="dsb-id">nickName</p>
            </div>
        </div>

        <div class="nav">
            <ul>
                <li>
                    <i class="idt"></i>
                    <p>200</p>
                </li>
                <li class="pt-line">
                    <i class="clt"></i>
                    <p>3000</p>
                </li>
                <li>
                    <i class="rcm"></i>
                    <p>卡劵</p>
                </li>
            </ul>
        </div>
        <section class="mt-3">
            <div class="ps-lt">
                <div class="lt-dsb">
                    <p>我的订单</p>
                    <i class="arr-right"></i>
                </div>
            </div>
            <div class="ps-lt">
                <div class="lt-dsb">
                    <p>优惠抽奖</p>
                    <i class="arr-right"></i>
                </div>
            </div>
            <div class="ps-lt">
                <div class="lt-dsb">
                    <p>领取积分</p>
                    <i class="arr-right"></i>
                </div>
            </div>
            <div class="ps-lt">
                <div class="lt-dsb cl-bb">
                    <p>问题帮助</p>
                    <i class="arr-right"></i>
                </div>
            </div>
        </section>

        <div class="jg"></div>
    </div>



	<div class="mune">
    	<img src="images/1.png">
      <a href="/"><p>首页</p></a>
    </div>
	<div class="mune">
    	<img src="images/2.png">
        <p>商家</p>
    </div>
	<div class="mune">
    	<img src="images/3.png">
        <p>申请加盟</p>
    </div>
	<div class="mune">
    	<img src="images/4.png">
        <p>个人中心</p>
    </div>
@push('js')
    <script>
        (function (doc, win) {
            var docEl = doc.documentElement,
                resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
                recalc = function () {
                    var clientWidth = docEl.clientWidth;
                    if (!clientWidth) return;
                    docEl.style.fontSize = 100 * (clientWidth / 750) + 'px';
                };

            if (!doc.addEventListener) return;
            win.addEventListener(resizeEvt, recalc, false);
            doc.addEventListener('DOMContentLoaded', recalc, false);
        })(document, window);
    </script>
    <script type="text/javascript">
        $('.check-on').click(function(){
            $(this).toggleClass('check-off');
        })
    </script>
@endpush
@endsection