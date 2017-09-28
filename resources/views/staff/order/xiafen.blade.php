@extends('staffLayOut')

@section('content')
    <style>
        .pagination {
            display: inline-flex !important;
        }
    </style>
    <div class="row m-l-15 m-t-15">
        <span class="font-title m-l-15" style="font-size: 15px">订单管理--下分订单</span>
    </div>

    <div class="row m-l-15 m-t-15">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered">
                            <thead >
                            <tr>
                                <th>序</th>
                                <th>微信名称</th>
                                <th>游戏种类</th>
                                <th>下分金额</th>
                                <th>下分分值(万)</th>
                                <th>创建时间</th>
                                <th>下分截图</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody class="xiafenorderappend">
                            @foreach($data as $v)
                                <tr>
                                    <td>{{ $v->id }}</td>
                                    <td>{{ $v->uname }}</td>
                                    <td>{{ $v->gname }}</td>
                                    <td>{{ $v->money }}</td>
                                    <td>{{ $v->value }}</td>
                                    <td>{{ $v->created_at }}</td>
                                    <td><button class="btn btn-success" picName="{{ $v->xiafen_picture }}" onclick="showPic(this)">查看截图</button></td>
                                    <td>
                                        <button class="btn btn-info" onclick="xiafenok({{ $v->id }})">下分完成</button>
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
    <script type="text/javascript" src="{{URL::asset('/js/layui/layui.js')}}"></script>
    <script>
        layui.use('layer',function(){
            window.layer = layui.layer;
        });

        function xiafenok(id){
               $.ajax({
                   url: "/staff/xiafenok",
                   type: "POST",
                   dataType: "json",
                   data:{id:id},
                   headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                   success: function (data) {
                           console.log(data);
                   }
               });
           }

       //查看下分截图
        function showPic(obj) {
            layer.open({
                type: 1,
                title: '查看下分截图',
                closeBtn: 0,
                area: ['480px', '350px'],
                offset: '200px',
                skin: 'layui-layer-nobg',
                shadeClose: true,
                content: '<img src="/staff/getPicPath/'+$(obj).attr('picName')+'"/>'
            });
        }
</script>
@endsection