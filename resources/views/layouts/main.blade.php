<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <!-- IE8以下版本不兼容的问题-->
    <meta http-equip="X-UA-Compatibal" content="IE=edge,chrome=1">
    <!-- 360浏览器-->
    <meta name="renderer" content="webkit">
    <meta name="author" content="fish">
    <meta name="keywords" content="bootstrap,css,html">
    <meta name="description" content="fish">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>fish</title>
    {{--<link rel="stylesheet" href="{{url(elixir("css/theme.src.css"))}}" type="text/css"/>--}}
{{--    <link rel="stylesheet" href="{{url(elixir("css/app.src.css"))}}" type="text/css"/>--}}
    {{--<link rel="stylesheet" href="{{asset('fonts/icofont/iconfont.css')}}">--}}
    {{--<link rel="stylesheet" href="{{asset('fonts/icofont/iconfont.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset(("web/css/swiper-3.4.0.min.css"))}}">--}}
    <link rel="stylesheet" href="{{asset(("css/bootstrap.min.css"))}}">

    {{--<link rel="stylesheet" href="{{asset('web/css/index.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{asset('web/css/house_reg.css')}}">--}}
    {{--    <link rel="stylesheet" href="{{asset(("web/css/filter.css"))}}">--}}
    {{--    <link rel="stylesheet" href="{{asset(("web/css/article_list.css"))}}">--}}
    {{--    <link rel="stylesheet" href="{{asset(("web/css/article.css"))}}">--}}
    {{--    <link rel="stylesheet" href="{{asset(("web/css/request.css"))}}">--}}
    {{--<link rel="stylesheet" href="{{asset(("web/css/submit.css"))}}">--}}
    {{--<link rel="stylesheet" href="{{asset(("web/css/current_location.css"))}}">--}}
    {{--<link rel="stylesheet" href="{{asset(("web/css/building_detail.css"))}}">--}}
    {{--<link rel="stylesheet" href="{{asset(("web/css/about_us.css"))}}">--}}

    @yield('css')
</head>
<body id="main">
@yield('header')
@yield('content')
@yield('footer')

{{--<script src="{{ url('vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>--}}
{{--<script src="{{ url('web/js/swiper-3.4.0.jquery.min.js') }}"></script>--}}
<script src="{{url('js/jquery-1.8.2.min.js')}}"></script>
{{--<script src="{{url('web/js/index.js')}}"></script>--}}
{{--<script src="{{url('web/js/current_location.js')}}"></script>--}}
{{--<script src="{{url('web/js/article_list.js')}}"></script>--}}
{{--<script src="{{url('web/js/article.js')}}"></script>--}}
{{--<script src="{{url('web/js/building_detail.js')}}"></script>--}}
{{--<script src="{{url('web/js/request.js')}}"></script>--}}
{{--<script src="{{url('web/js/submit.js')}}"></script>--}}
{{--<script src="{{url('web/js/filter_find.js')}}"></script>--}}
{{--<script src="{{url('web/js/about_us.js')}}"></script>--}}
{{--<script src="{{url(elixir('js/app.src.js'))}}"></script>--}}

@stack('js')
</body>
</html>