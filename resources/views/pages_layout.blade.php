<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <link rel="shortcut icon" href="{{URL::asset('img/114923221741479294.png')}}">

        <title>银商后台管理页面</title>
    <!-- Bootstrap core CSS -->
    <link href="{{URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/bootstrap-reset.css')}}" rel="stylesheet">

    <!--Animation css-->
    <link href="{{URL::asset('css/animate.css')}}" rel="stylesheet">

    <!--Icon-fonts css-->
   <!--  <link href="{{URL::asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" /> -->
    <link href="{{URL::asset('assets/ionicon/css/ionicons.min.css')}}" rel="stylesheet" />
   <!--  <link href="{{URL::asset('assets/material-design-iconic-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" /> -->

    <!-- Custom styles for this template -->
    <link href="{{URL::asset('css/style.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/helper.css')}}" rel="stylesheet">

    <!--custom style-->
    <link rel="stylesheet" href="{{URL::asset('css/main.css')}}"/>


</head>
  @yield('content')
  <div class="login_footer footer">
    <div class="login_contact">
        <ul>
            <li><h3>联系我们</h3></li>
            <li><span>QQ群：</span>199705167</li>
            <li><span>电话：</span>+31 88 888 9399</li>
            <li><span>下单邮箱：</span>order@easyxpress.nl</li>
        </ul>
    </div>
    <div class="copy">
        <p>Copyright: EE 速递 / EE Express</p>
    </div>
</div>



<!-- js placed at the end of the document so the pages load faster -->
<script src="{{URL::asset('js/jquery.js')}}"></script>
<script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('js/pace.min.js')}}"></script>
<script src="{{URL::asset('js/wow.min.js')}}"></script>
<script src="{{URL::asset('js/jquery.nicescroll.js')}}" type="text/javascript"></script>


<!--common script for all pages-->
<script src="{{URL::asset('js/jquery.app.js')}}"></script>

<script src="{{URL::asset('js/login.js')}}"></script>
<script src="{{URL::asset('js/register.js')}}"></script>
@yield('jquery')
</body>
</html>
