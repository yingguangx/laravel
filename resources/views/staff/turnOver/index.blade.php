@extends('staffLayOut')

@section('content')
    <div class="row m-l-15 m-t-15">
        <span class="font-title m-l-15" style="font-size: 15px">后台管理-经营情况</span>
    </div>

    <div class="row m-l-15 m-t-15">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row m-t-5">
                    <div class="col-md-3 col-md-offset-1">
                        <div class="col-md-4 m-t-5">
                            <p class="tar">选择日期:</p>
                        </div>
                        <div class="col-md-8">
                            <input type="text" placeholder="请选择时间" class="boxAdd" id="selDate">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="col-md-4 m-t-5">
                            <p class="tal">选择时间:</p>
                        </div>
                        <div class="col-md-8">
                            <input type="text" placeholder="请选择时间" class="boxAdd" id="selTime">
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="col-md-4 col-md-offset-1 ">
                            <button class="btn btn-info">查询</button>
                        </div>
                    </div>
                </div>

                <div class="panel-body m-t-15" style="background-color: white;">
                    <div class="row m-t-5">
                        <div class="col-md-3 text-right">
                            <label >下分合计：</label>
                        </div>
                        <div class="col-md-8">
                            <span style="color: blue;">(集结号)</span>18483000
                            &nbsp;&nbsp;&nbsp;
                            <span style="color: blue;">(辰龙)</span>162000
                        </div>
                    </div>
                    <div class="row m-t-15">
                        <div class="col-md-3 text-right">
                            <label >上分合计：</label>
                        </div>
                        <div class="col-md-8">
                            <span style="color: blue;">(集结号)</span>18483000
                            &nbsp;&nbsp;&nbsp;
                            <span style="color: blue;">(辰龙)</span>162000
                        </div>
                    </div>
                    <div class="row m-t-15">
                        <div class="col-md-3 text-right">
                            <label >会员充值合计：</label>
                        </div>
                        <div class="col-md-9">
                            ￥5000
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jquery')
    <script>

        //设置ajax头部
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });

        //初始化layui
        layui.use(' layer',function(){
            window.layer = layui.layer;
        })

        //初始化laydate日期时间组件
        layui.use('laydate', function(){
            var laydate = layui.laydate;
            laydate.render({
                elem: '#selTime',
                type: 'time'
            });
        });

        //注：选择时间之后要点确定
        layui.use('laydate', function(){
            var laydate = layui.laydate;
            laydate.render({
                elem: '#selDate'
            });
        });
    </script>
@endsection
