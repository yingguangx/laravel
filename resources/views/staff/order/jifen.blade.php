@extends('staffLayOut')

@section('content')
    <div class="row m-l-15 m-t-15">
        <span class="font-title m-l-15" style="font-size: 15px">订单管理--积分订单</span>
    </div>

    <div class="row m-l-15 m-t-15">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-11">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>序</th>
                                <th>游戏种类</th>
                                <th>上分金额</th>
                                <th>上分分值(万)</th>
                                <th>上分账号</th>
                                <th>创建时间</th>
                                <td>操作</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $v)
                                <tr>
                                    <td>{{ $v->id }}</td>
                                    <td>{{ $v->name }}</td>
                                    <td>{{ $v->money }}</td>
                                    <td>{{ $v->value }}</td>
                                    <td>{{ $v->game_account }}</td>
                                    <td>{{ $v->created_at }}</td>
                                    <td>
                                        <button class="btn btn-info" onclick="shangfenok({{ $v->id }})">设置完成</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row m-t-15">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="dataTables_info" id="datatable_info" role="status"
                                 aria-live="polite">显示 {{ $data->firstItem() }} 到 {{ $data->lastItem() }} 共 {{ $data->total() }} 条
                            </div>
                        </div>
                        <div class="col-sm-6 text-right">
                            <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                                {!! $data->links() !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('jquery')
    <script type="text/javascript" src="{{asset('/js/layui/layui.js')}}"></script>

    <script>
        //初始化layui
        layui.use('layer',function(){
            window.layer = layui.layer;
        })

        function shangfenok(id){
            $.ajax({
                url: "/staff/shangfenok",
                type: "POST",
                dataType: "json",
                data:{id:id},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    layer.msg('该订单已完成!!', {time:1000});
                }
            });
        }

    </script>
@endsection