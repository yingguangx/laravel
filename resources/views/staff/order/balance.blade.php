@extends('staffLayOut')

@section('content')
    <table class="table-responsive table-hover table-striped table table-bordered">
        <caption>
            余额兑换
        </caption>
        <thead>
        <tr>
            <th>微信名称</th>
            <th>兑换金额</th>
            <th>收款类型</th>
            <th>收款账号</th>
            <th>收款人姓名</th>
            <th>收款人收款码</th>
            <th>时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody class="moneychangeorderappend">
        <?php foreach ($orders as $key => $order) {
        ?>
        <tr>
            <td><?php echo $order->name ?></td>
            <td><?php echo $order->money ?></td>
            <td><?php echo $order->payeesort ?></td>
            <td><?php echo $order->payeeaccount ?></td>
            <td><?php echo $order->payeename ?></td>
            <td><?php echo $order->payeecode ?><img src="" alt=""></td>
            <td><?php echo $order->created_at ?></td>
            <td><button class="moneychangeok" onclick="moneychangeok(<?php echo $order->id ?>)">下分完成点击</button></td>
        </tr>
        <?php } ?>
        </tbody>
        <tfoot>
        <td colspan="7" class="text-center">分页</td>
        </tfoot>
    </table>
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