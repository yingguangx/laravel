@extends('staffLayOut')

@section('content')
	<table class="layui-table" id="userList" lay-filter="user">
	</table>
@endsection

@section('jquery')
	<script type="text/html" id="barDemo">
		<a class="layui-btn layui-btn-primary layui-btn-mini" lay-event="detail">查看</a>
		<a class="layui-btn layui-btn-mini" lay-event="edit">编辑</a>
		<a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="del">删除</a>
	</script>
	<script type="text/javascript" src="{{URL::asset('/js/layui/layui.all.js')}}"></script>
	<script>
		layui.use('layer',function(){
				window.layer = layui.layer;
		});
    layui.use('table', function(){
        var table = layui.table;
        table.render({ //其它参数在此省略
            elem: '#userList', //或 elem: document.getElementById('test') 等
            cols:  [[ //标题栏
                {checkbox: true},
                {field:'id',title:'ID',width:80,sort:true},
								{field:'name', title:'姓名',width:80},
								{field:'money', title:'余额',width:80,sort:true},
								{field:'nickName', title:'昵称',width:80},
								{field:'district', title:'地区',width:80},
								{field:'city', title:'城市',width:80},
								{field:'key', title:'签名',width:177},
								{field:'points', title:'积分',width:80,sort:true},
								{field:'headImgUrl', title:'头像',width:80},
								{field:'status', title:'状态',width:80},
								{field:'created_at', title:'创建时间',width:135},
                {fixed: 'right', title:'操作', width:160, align:'center', toolbar: '#barDemo'}
            ]],
            url:'/staff/user/apiGetUser',
            where:{_token:'{{ csrf_token() }}'},
						method:'post',
            page:true,
            id:'user',
						sort:true,
						loading: true,
            limit: 30, //默认采用60
        });

        table.on('tool(user)', function(obj){
            var data = obj.data;
            if(obj.event === 'detail'){
                layer.msg('ID：'+ data.id + ' 的查看操作');
                layer.open({
                    title:'查看'+data.name+'的收款码',
                    content: '请选择收款码类型'
                    ,btn: ['微信收款码', '支付宝收款码']
                    ,yes: function(){
                        layer.open({
                            type: 1,
                            area: '30%',
                            offset: '100px',
                            title:data.name+'的微信收款码',
                            content: '<img src="/staff/user/wechatCode?user_id='+data.id+'" title="该用户未上传" width="100%">' //这里content是一个URL，如果你不想让iframe出现滚动条，你还可以content: ['http://sentsin.com', 'no']
                        });
                    }
                    ,btn2: function(){
                        layer.open({
                            type: 1,
                            area: '30%',
                            offset: '100px',
                            title:data.name+'的支付宝收款码',
                            content: '<img src="/staff/user/ztbCode?user_id='+data.id+'" title="该用户未上传" width="100%">' //这里content是一个URL，如果你不想让iframe出现滚动条，你还可以content: ['http://sentsin.com', 'no']
                        });
                    }
                });

            } else if(obj.event === 'del'){
                layer.confirm('真的删除行么', function(index){
                    obj.del();
                    layer.close(index);
                });
            } else if(obj.event === 'edit'){
//                layer.alert('编辑行：<br>'+ JSON.stringify(data))
								layer.msg('暂无编辑功能！');
            }
        });
    });

</script>
@endsection
