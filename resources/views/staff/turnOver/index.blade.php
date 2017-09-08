@extends('staffLayOut')

@section('content')
    <div class="row m-l-15 m-t-15">
        <span class="font-title">后台管理-营业情况</span>
    </div>

    <div class="row m-l-15 m-t-15">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row m-t-5">
                    <div class="col-md-4">
                        <div class="col-md-4">
                            <p class="tar m-t-5">游戏种类:</p>
                        </div>
                        <div class="col-md-8">
                            <select class="select-default">
                                <option value="">请选择游戏类目</option>
                                <option value="1">集结号</option>
                                <option value="2">辰龙</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="col-md-4 m-t-5">
                            <p class="tar ">选择时间:</p>
                        </div>
                        <div class="col-md-8">
                            <input type="text" placeholder="请选择时间" class="boxAdd" id="selTime">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="col-md-4 col-md-offset-1 ">
                            <button class="btn btn-info">查询</button>
                        </div>
                    </div>
                </div>

                {{--<div class="row m-t-15">--}}
                    {{--<div class="col-md-1">--}}
                        {{--<a href="" class="btn btn-info w-lg" >更新数据</a>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-3 clh">--}}
                        {{--本次刷新时间 2017-09-12 11:22:21--}}
                    {{--</div>--}}
                {{--</div>--}}

                <div class="panel-body m-t-15" style="background-color: white;">
                    <div class="row m-t-5">
                        <div class="col-md-2 text-right">
                            <label >下分合计：</label>
                        </div>
                        <div class="col-md-9">
                            18483000
                        </div>
                    </div>
                    <div class="row m-t-15">
                        <div class="col-md-2 text-right">
                            <label >上分合计：</label>
                        </div>
                        <div class="col-md-9">
                            678456000
                        </div>
                    </div>
                    <div class="row m-t-15">
                        <div class="col-md-2 text-right">
                            <label >会员充值合计：</label>
                        </div>
                        <div class="col-md-9">
                            ￥5000
                        </div>
                    </div>
                    <div class="row m-t-15">
                        <div class="col-md-2 text-right">
                            <label >总营业额合计：</label>
                        </div>
                        <div class="col-md-9">
                            ￥4575
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jquery')
    <script type="text/javascript" src="{{asset('/layui/layui.js')}}"></script>

    <script>
        //设置ajax头部
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        //初始化layui
        layui.use('layer',function(){
            window.layer = layui.layer;
        })
        //初始化laydate
        layui.use('laydate', function(){
            var laydate = layui.laydate;
            //执行一个laydate实例
            laydate.render({
                elem: '#selTime'
            });
        });
    </script>
@endsection
