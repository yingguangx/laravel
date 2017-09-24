@extends('staffLayOut')

@section('content')
    <div class="row m-l-15 m-t-15">
        <span class="font-title m-l-15" style="font-size: 15px">订单管理--余额兑换</span>
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
                                <th>微信名称</th>
                                <th>兑换金额</th>
                                <th>收款类型</th>
                                <th>收款账号</th>
                                <th>收款人姓名</th>
                                <th>收款码</th>
                                <th>创建时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $v)
                                <tr>
                                    <td>{{ $v->name }}</td>
                                    <td>{{ $v->money }}</td>
                                    <td>{{ $v->payeesort }}</td>
                                    <td>{{ $v->payeeaccount }}</td>
                                    <td>{{ $v->payeename }}</td>
                                    <td>{{ $v->payeecode }}</td>
                                    <td>{{ $v->created_at }}</td>
                                    <td>
                                        <button class="btn btn-info moneychangeok" onclick="moneychangeok({{ $v->id }})">设置完成</button>
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
<script>
     function moneychangeok(id){
           $.ajax({
               url: "/staff/moneychangeok",
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
</script>
@endsection