@extends('staffLayOut')

@section('content')
    <div class="row m-l-15 m-t-15">
        <span class="font-title m-l-15" style="font-size: 15px">系统设置-积分设置</span>
    </div>

    <div class="row m-l-15 m-t-15">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    @if ($data)
                    <div class="col-md-7">
                        <span style="margin-top: 8px;display:block;">
                            当前设置:当上分充值金额达到<span style="color:blue;">{{ $data->limit_value }}</span>元时，系统赠送<span style="color:blue;">{{ $data->integration }}</span>积分。每<span style="color:blue;">{{ $data->start_value }}</span>积分可兑换<span style="color:blue;">{{ $data->get_value }}万</span>游戏分值！
                        </span>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-info" onclick="editIntegration({{ $data->limit_value }},{{ $data->integration }},{{ $data->start_value }},{{ $data->get_value }})">修改</button>
                    </div>
                    @else
                    <div class="col-md-7">
                    <span style="margin-top: 8px;display:block;">
                        当前暂未设置上分积分设置
                    </span>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-info" onclick="addIntegration()">添加</button>
                    </div>
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
        //新增上分积分规则
        function addIntegration() {
            var content =
                    '<div class="m-t-5">'
                    +'<div class="fl" style="width: 40%;text-align: right;margin-left: 20px;"><span>充值金额:</span></div>'
                    +'<div class="fl" style="width: 40%;text-align: left;margin-left: 10px;"><input class="input-default m" type="text" value=""></div>'
                    +'<div class="clear"></div>'
                    +'</div>'
                    +'<div>'
                    +'<div class="fl" style="width: 40%;text-align: right;margin-left: 20px;"><span>积分:</span></div>'
                    +'<div class="fl" style="width: 40%;text-align: left;margin-left: 10px;"><input class="input-default n" type="text" value=""></div>'
                    +'<div class="clear"></div>'
                    +'</div>'
                    +'<div>'
                    +'<div class="fl" style="width: 40%;text-align: right;margin-left: 20px;"><span>积分起兑分值:</span></div>'
                    +'<div class="fl" style="width: 40%;text-align: left;margin-left: 10px;"><input class="input-default p" type="text" value=""></div>'
                    +'<div class="clear"></div>'
                    +'</div>'
                    +'<div>'
                    +'<div class="fl" style="width: 40%;text-align: right;margin-left: 20px;"><span>游戏分值:</span></div>'
                    +'<div class="fl" style="width: 40%;text-align: left;margin-left: 10px;"><input class="input-default q" type="text" value="万"></div>'
                    +'<div class="clear"></div>'
                    +'</div>'
                    +'<div>';

            layer.confirm(content, {
                btn: ['取消','确定']
            }, function(){
                layer.closeAll('dialog');
            }, function(){
                var m = $('.m').val();
                var n = $('.n').val();
                var p = $('.p').val();
                var q = $('.q').val();

                var reg=/[\u4E00-\u9FA5]/g;
                q=q.replace(reg,'');
                $.ajax({
                    url:'addIntegration',
                    type: 'post',
                    dataType: 'json',
                    data:{
                        limit_value:m,
                        integration:n,
                        start_value:p,
                        get_value:q
                    },
                    success:function(data){
                        if (data) {
                            layer.msg('添加成功！！',{time:1500});
                            window.location.reload();
                        }
                    }
                })
            });
        }
        //修改积分规则
        function editIntegration(m,n,p,q) {
            var content =
                    '<div>'
                    +'<div class="fl" style="width: 40%;text-align: right;margin-left: 20px;"><span>充值金额:</span></div>'
                    +'<div class="fl" style="width: 40%;text-align: left;margin-left: 10px;"><input class="input-default m" type="text" value="'+m+'"></div>'
                    +'<div class="clear"></div>'
                    +'</div>'
                    +'<div>'
                    +'<div class="fl" style="width: 40%;text-align: right;margin-left: 20px;"><span>积分:</span></div>'
                    +'<div class="fl" style="width: 40%;text-align: left;margin-left: 10px;"><input class="input-default n" type="text" value="'+n+'"></div>'
                    +'<div class="clear"></div>'
                    +'</div>'
                    +'<div>'
                    +'<div class="fl" style="width: 40%;text-align: right;margin-left: 20px;"><span>积分起兑分值:</span></div>'
                    +'<div class="fl" style="width: 40%;text-align: left;margin-left: 10px;"><input class="input-default p" type="text" value="'+p+'"></div>'
                    +'<div class="clear"></div>'
                    +'</div>'
                    +'<div>'
                    +'<div class="fl" style="width: 40%;text-align: right;margin-left: 20px;"><span>游戏分值:</span></div>'
                    +'<div class="fl" style="width: 40%;text-align: left;margin-left: 10px;"><input class="input-default q" type="text" value="'+q+'万"></div>'
                    +'<div class="clear"></div>'
                    +'</div>'
                    +'<div>';

            layer.confirm(content, {
                btn: ['取消','确定']
            }, function(){
                layer.closeAll('dialog');
            }, function(){
                var m = $('.m').val();
                var n = $('.n').val();
                var p = $('.p').val();
                var q = $('.q').val();

                var reg=/[\u4E00-\u9FA5]/g;
                q=q.replace(reg,'');

                $.ajax({
                    url:'editIntegration',
                    type: 'post',
                    dataType: 'json',
                    data:{
                        limit_value:m,
                        integration:n,
                        start_value:p,
                        get_value:q
                    },
                    success:function(data){
                        if (data) {
                            layer.msg('修改成功！！', {time:1500});
//                            window.location.reload();
                        }
                    }
                })
            });
        }
    </script>
@endsection
