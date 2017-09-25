<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <!-- Bootstrap core CSS -->
{{--    <link href="{{URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">--}}
    @stack('css')
    @yield('style')
    <style>
        .rt-bk {
            position: absolute;
            top: 0.27rem;
            left: 0.15rem;
            float: left;
        }
        .top-name {
            text-align: center;
            font-size: 0.34rem;
            line-height: 0.84rem;
        }
        .bk {
            display: block;
            margin: 0.045rem 0.25rem 0 0;
            float: left;
            width: 0.15rem;
            height: 0.24rem;
            background: url(../images/rt-bk.png) no-repeat;
            background-size: 0.15rem 0.24rem;
        }
        .rt-bk a{
            float: left;
            margin-top: -5px;
        }
    </style>
</head>
<body>

<section class="container">
    @yield('content')
</section>
<footer>
    <script src="{{URL::asset('js/jquery.min.js')}}"></script>
{{--    <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>--}}
    @stack('scripts')
    @yield('inner_script')
</footer>
</body>

</html>
