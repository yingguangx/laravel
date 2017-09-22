@extends('staffLayOut')

@section('content')
    <table class="table-responsive table-hover table-striped table table-bordered">
        <caption>
            上分订单
        </caption>
        <thead>
        <tr>
            <th>微信名称</th>
            <th>游戏种类</th>
            <th>上分金额</th>
            <th>上分分数 </th>
            <th>游戏id</th>
            <th>时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody class="shangfenorderappend">
        <tr>
            <td>测试</td>
            <td>测试</td>
            <td>测试</td>
            <td>测试</td>
            <td>测试</td>
            <td>测试</td>
            <td>测试</td>
        </tr>
        <tr>
            <td>测试</td>
            <td>测试</td>
            <td>测试</td>
            <td>测试</td>
            <td>测试</td>
            <td>测试</td>
            <td>测试</td>
        </tr>
        </tbody>
        <tfoot>
        <td colspan="6" class="text-center">分页</td>
        </tfoot>
    </table>
@endsection

@section('jquery')
<script>
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
                       console.log(data);
                   }
           });
       }
       
</script>
@endsection