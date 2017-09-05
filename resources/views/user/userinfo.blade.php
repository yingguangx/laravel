@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="{{url(elixir("css/user.css"))}}" type="text/css"/>
    <link rel="stylesheet" href="{{url(elixir("css/layer.css"))}}" type="text/css"/>
@endsection

@section('content')
    <div id="_centent">
        <header>
            <div class="rt-bk">
                <i class="bk"></i>
                <a href="/">
                    <p>返回</p>
                </a>
            </div>
            <div class="top-name"><p>设置付款码</p></div>
        </header>
        <div class="head">

        </div>

        <div style="text-align: center">
            <button type="button" class="layui-btn" id="test1">
                <i class="layui-icon">&#xe67c;</i>上传图片
            </button>
        </div>

        <i class="layui-icon" style="font-size: 30px; color: #1E9FFF;">&#xe60c;</i>
        <div class="nav">
            <ul>
                <li>
                    <i class="idt"></i>
                    <p>余额</p>
                    <span>200</span>
                </li>
                <li class="pt-line">
                    <i class="clt"></i>
                    <p>积分</p>
                    <span>3000</span>
                </li>
                <li>
                    <i class="rcm"></i>
                    <p>卡劵</p>
                    <span>0</span>
                </li>
            </ul>
        </div>
        <section class="mt-3">

        </section>

        <div class="jg"></div>
    </div>
@endsection
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
    $('.lt-order').on('click',function () {
        $('.ps-xl').slideToggle();
    })
</script>
<script type="text/javascript" src="{{asset('/js/layui/layui.all.js')}}"></script>
<script type="text/javascript">

</script>
@endpush