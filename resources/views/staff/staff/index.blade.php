@extends('staffLayOut')

@section('content')
    <style>
    table th, .table td {
        text-align: center;
        vertical-align: middle !important;
    }
    </style>
    <div class="row m-l-15 m-t-15">
        <span class="font-title m-l-15" style="font-size: 15px">员工管理-员工列表</span>
    </div>

    <div class="row m-l-15 m-t-15">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-4">
                        @if(count($data) == 0)
                        <span style="margin-top: 8px;display:block;">
                            当前系统暂无员工！
                        </span>
                        @else
                        <span style="margin-top: 8px;display:block;">
                            欢迎登录集结号微信后台，员工管理页！
                        </span>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-info" onclick="addStaff()">添加</button>
                    </div>
                </div>

                <div class="row">
                    <div id="addBox" style="display: none;" class="col-md-4">
                        <div class="row m-t-15 m-l-15">
                            <div class="col-md-4"><span>员工姓名:</span></div>
                            <div class="col-md-8"><input class="boxAdd m" type="text" value=""></div>
                        </div>
                        <div class="row m-t-15 m-l-15">
                            <div class="col-md-4"><span>角色选择:</span></div>
                            <div class="col-md-8">
                                <select class="select-default w">
                                    <option value="">请选择角色</option>
                                    <option value="1">超级管理员</option>
                                    <option value="2">管理员</option>
                                </select>
                            </div>
                        </div>
                        <div class="row m-t-15 m-l-15">
                            <div class="col-md-4"><span>登录账号:</span></div>
                            <div class="col-md-8"><input class="boxAdd n" type="text" value=""></div>
                        </div>
                        <div class="row m-t-15 m-l-15">
                            <div class="col-md-4"><span>输入密码:</span></div>
                            <div class="col-md-8"><input class="boxAdd p" type="password" value=""></div>
                        </div>
                        <div class="row m-t-15 m-l-15">
                            <div class="col-md-4"><span>确认密码:</span></div>
                            <div class="col-md-8"><input class="boxAdd q" type="password" value=""></div>
                        </div>
                        <div id="appendBox">

                        </div>

                        <div class="row m-t-15 m-l-15">
                            <div class="col-md-2 col-md-offset-2" id="buttonChange">
                                <button class="btn btn-info" onclick="addStaffInfo()">确定</button>
                            </div>
                        </div>
                    </div>

                    @if(count($data) != 0)
                    <div class="col-md-7 m-t-15">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>序</th>
                                <th>员工姓名</th>
                                <th>登录账号</th>
                                <th>账号角色</th>
                                <th>账号状态</th>
                                <td>操作</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $value)
                            <tr>
                                <td>{{ $value['id'] }}</td>
                                <td>{{ $value['name'] }}</td>
                                <td>{{ $value['email'] }}</td>
                                <td>
                                    @if($value['role'] == 2)
                                        管理员
                                    @else
                                        超级管理员
                                    @endif
                                </td>
                                <td>
                                    @if($value['status'] == 2)
                                        禁用
                                    @else
                                        正常
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-success" role="{{ $value['role'] }}" status="{{ $value['status'] }}" onclick="editStaff(this)">修改</button>
                                    <button class="btn btn-danger" staffId="{{ $value['id'] }}" onclick="delStaff(this)">删除</button>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jquery')
    <script type="text/javascript" src="{{asset('/js/layui/layui.js')}}"></script>
    <script>
        //设置ajax头部
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });

        //初始化layui
        layui.use('layer',function(){
            window.layer = layui.layer;
        })

        //员工新增
        function addStaff() {
            $('.m').val('');
            $('.n').val('');
            $('#appendBox').html('');
            $('#addBox').show();
        }

        //账号验证
        $('.n').blur(function () {
            $.ajax({
                url:'checkAccount',
                type: 'post',
                dataType: 'json',
                data:{
                    account:$('.n').val()
                },
                success:function(data){
                    if (data) {
                        layer.tips('该账号已存在!', '.n', {
                            tips: ['2','red']
                        });
                        $('.n').val('');
                    }
                }
            })
        })

        //验证密码
        $('.q').blur(function () {
            var password = $('.p').val();
            var repassword = $('.q').val();

            if (password != repassword) {
                layer.tips('两次密码不一致!', '.q', {
                    tips: ['2','red']
                });
                $('.p').val('');
                $('.q').val('');
            }
        })
        
        //员工新增或修改
        function addStaffInfo(type) {
            var type = arguments[0] ? arguments[0] : 1;

            var name = $('.m').val();
            var role = $('.w').val();
            var account = $('.n').val();
            var password = $('.p').val();
            if (type == 1) {
                $.ajax({
                    url:'addAccount',
                    type: 'post',
                    dataType: 'json',
                    data:{
                        name:name,
                        email:account,
                        password:password,
                        role:role
                    },
                    success:function(data){
                        if (data) {
                            window.location.reload();
                        }
                    }
                })
            } else {
                var status = $("input[name='status']:checked").val();
                var id = $('#hiddenId').val();
                $.ajax({
                    url:'editStaff',
                    type: 'post',
                    dataType: 'json',
                    data:{
                        name:name,
                        email:account,
                        password:password,
                        role:role,
                        status:status,
                        id:id
                    },
                    success:function(data){
                        if (data) {
                            window.location.reload();
                        }
                    }
                })
            }
        }

        //员工删除
        function delStaff(obj) {
            layer.msg('确定删除吗？', {
                time: 0
                ,btn: ['确定', '取消']
                ,yes: function(index){
                    var id = $(obj).attr('staffId');

                    $.ajax({
                        url:'delStaff',
                        type: 'post',
                        dataType: 'json',
                        data:{
                            id:id
                        },
                        success:function(data){
                            if (data) {
                                window.location.reload();
                            }
                        }
                    })
                }
            });
        }

        //员工修改
        function editStaff(obj) {
            layer.msg('若输入密码则表示重置该员工密码，不输入密码表示仅修改该员工信息。', {time:4000});

            var parent = $(obj).parent().parent();
            var id = parent.children().eq(0).html();
            var name = parent.children().eq(1).html();
            var email = parent.children().eq(2).html();
            var role = $(obj).attr('role');
            var status = $(obj).attr('status');

            $('.m').val(name);
            $('.n').val(email);

            $("option").each(function(){
                var v= $(this).val();
                if (v == role) {
                    $(this).attr('selected', true);
                }
            })

            var html =
                '<div class="row m-t-15 m-l-15">'
                        +'<div class="col-md-4"><span>账号状态:</span></div>'
                        +'<div class="col-md-8">';
            if (status == 1) {
                html+=
                            '<input name="status" type="radio" value="1" checked/>正常'
                            +'<input name="status" type="radio" value="2" />禁用'
                        +'</div>'
                +'</div>';
            } else {
                html+=
                            '<input name="status" type="radio" value="1" />正常'
                            +'<input name="status" type="radio" value="2" checked/>禁用'
                        +'</div>'
                +'</div>';
            }

            $('#buttonChange').html('');
            $('#buttonChange').append(
                '<button class="btn btn-info" onclick="addStaffInfo(2)">确定</button>'
                +'<input type="hidden" id="hiddenId" value="'+id+'">'
        );
            $('#appendBox').html('');
            $('#appendBox').append(html);
            $('#addBox').show();
        }
    </script>
@endsection
