@extends('pages_layout')

@section('content')

    <body>
        <div class="wrapper-page overflow_cu">
            <div class="panel panel-color panel-inverse">
                <div class="panel-heading">
                   <h3 class="text-center m-t-10"><strong>登录</strong> </h3>
                </div>
                <div class="col-md-12 login_body">
                    <div class="panel-body">
                        <form id="form" class="form-horizontal m-t-10 p-20 p-b-0" method="post" action="login">
                            {{ csrf_field() }}
                            <div class="input-group m-b-15">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" id="js_form_name" name="account" class="form-control" placeholder="输入邮箱账号或客户编号">
                            </div>

                            <div class="input-group m-b-15">
                                <span class="input-group-addon"><i class="zmdi zmdi-eye-off"></i></span>
                                <input type="password" id="js_form_pwd" name="password" class="form-control" placeholder="输入登录密码">
                            </div>
                         
                            <div class="col-xs-12 m-t-15 p-0">
                                <div class="alert alert-warning"></div>
                            </div>

                            <div class="form-group text-right">
                                <div class="col-xs-12">
                                    <button class="btn btn-success col-xs-12" id="btn-login" onclick="checkForm()" type="button">登录</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
        @section('jquery')
        <script type="text/javascript">
            $("#js_form_captcha").keyup(function(event){
                if(event.keyCode ==13){
                    $("#btn-login").trigger("click");
                }
            });


            $("#js_form_pwd").keyup(function(event){
                if(event.keyCode ==13){
                    $("#btn-login").trigger("click");
                }
            });
        </script>
@endsection