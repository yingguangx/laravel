@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="{{url(elixir('css/user.css'))}}" type="text/css"/>
    <link rel="stylesheet" href="{{url(elixir('css/layer.css'))}}" type="text/css"/>
    <link rel="stylesheet" href="{{url(elixir('css/uploader/uploader.css'))}}" type="text/css"/>
@endsection

@section('content')
    <div id="_centent">
        <header>
            <div class="rt-bk">
                <i class="bk"></i>
                <a href="javascript:window.history.go(-1)">
                    <p>返回</p>
                </a>
            </div>
            <div class="top-name"><p>订单列表</p></div>
        </header>
        <section class="mt-3">

            @foreach(\Illuminate\Support\Facades\Auth::user()->userOrder as $order)
                <div class="ps-lt ps-xl">
                    <div class="lt-dsb">
                        @if($order->type == 1)
                            <p>{{ $order->user->name }}为账号{{ $order->game_account }}上分了{{ $order->money }}元</p>
                        @else
                            <p>{{ $order->user->name }}为账号{{ $order->game_account }}下分了{{ $order->money }}元</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </section>

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
<script type="text/javascript" src="{{asset('/js/layui/layui.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/uploader/demo-preview.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/uploader/dmuploader.js')}}"></script>
<script type="text/javascript">


</script>
@endpush