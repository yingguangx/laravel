<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <!-- Bootstrap core CSS -->
        <link href="{{URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('css/bootstrap-reset.css')}}" rel="stylesheet">
        <link href="{{URL::asset('css/jquery-ui.css')}}" rel="stylesheet" />
        <link href="{{URL::asset('css/jquery-confirm.css')}}" rel="stylesheet" />
        <link href="{{URL::asset('css/bootstrapValidator.css')}}" rel="stylesheet" />
        <link href="{{URL::asset('css/jquery-ui-timepicker-addon.css')}}" rel="stylesheet" />
    </head>
    <style>
       .big_frame{
            background:#5cb85c;
            margin-top:15px;
            text-align: center;
       } 
       .small_frame{
        border: 1px solid #F0DB4F;
        height:100%;
       }
     
    </style>
    <div class="big_frame row">
        <div class="small_frame">
            <div class="center_box row">
                <div class="row center_box1">
                    <span style="font-size: 22px;color:#FAFAFA;">0</span>
                </div>
                <div class="row center_box2">
                    <span style="font-size: 15px;color:#FAFAFA;">当前积分</span>
                </div>
            </div>
        </div>
    </div>
    <body>
    
    











        <script src="{{URL::asset('js/jquery.min.js')}}"></script>
        <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
        <script src="{{URL::asset('js/jquery.scrollTo.min.js')}}"></script>
        <script src="{{URL::asset('js/jquery.nicescroll.js')}}" type="text/javascript"></script>
        <script src="{{URL::asset('js/jquery.counterup.min.js')}}" type="text/javascript"></script>
        <script src="{{URL::asset('assets/sparkline-chart/jquery.sparkline.min.js')}}" type="text/javascript"></script>
        <script src="{{URL::asset('js/jquery.app.js')}}"></script>
        <script src="{{URL::asset('js/jquery.dashboard.js')}}"></script>
        <script src="{{URL::asset('js/jquery-ui.js')}}"></script>
        <script src="{{URL::asset('js/jquery-confirm.js')}}"></script>
        <script src="{{URL::asset('js/bootstrapValidator.js')}}"></script>
        <script src="{{URL::asset('assets/jquery.validate/jquery.validate.min.js')}}"></script>
        </script>
        <script>
        $(document).ready(function(){
            var big_width = parseInt($('.big_frame').css('width'));
            $('.big_frame').css('height',big_width/32*13+'px');
            $('.big_frame').css('padding',big_width/11+'px');
            $('.small_frame').css('padding',big_width/20+'px');
            $('.center_box2').css('margin-top',big_width/40+'px');
        })
        </script>

    </body>
</html>
