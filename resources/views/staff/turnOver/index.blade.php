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
                        <div class="col-md-4 m-t-5">
                            <p class="tar ">选择日期:</p>
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

                <div class="panel-body m-t-15" style="background-color: white;">
                <?php foreach ($game_value as $key => $game) {
               ?>
                    <div class="row m-t-5">
                        <div class="col-md-2 text-right">
                            <label ><?php echo $game['gname'] ?>游戏金币增长情况：</label>
                        </div>
                        <div class="col-md-9">
                            <span style="color: blue;"><?php echo $game['differ'] ?>万</span>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="row m-t-15">
                        <div class="col-md-2 text-right">
                            <label >人民币收入增长情况：</label>
                        </div>
                        <div class="col-md-9">
                            <span style="color: blue;"><?php echo $money_diff ?></span>
                        </div>
                    </div>
                    <div class="row m-t-15">
                        <div class="col-md-2 text-right">
                            <label >盈利情况：</label>
                        </div>
                        <div class="col-md-9">
                            ￥<span><?php echo $gain ?></span>
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
        layui.use(' layer',function(){
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
