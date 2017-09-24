@extends('staffLayOut')

@section('content')
<table class="table-responsive table-hover table-striped table table-bordered">
    <caption>
        <h3 >新订单</h3>
    </caption>
    <thead>
        <tr>
            <th>微信名称</th>
            <th>游戏种类</th>
            <th>下分金额（单位元）</th>
            <th>下分分数（单位万） </th>
            <th>下分截图</th>
            <th>时间</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody class="xiafenorderappend">
    <?php foreach ($orders as $key => $order) {
    ?>
        <tr>
            <td><?php echo $order->uname ?></td>
            <td><?php echo $order->gname ?></td>
            <td><?php echo $order->money ?></td>
            <td><?php echo $order->value ?></td>
            <td><?php echo $order->xiafen_picture ?></td>
            <td><?php echo $order->created_at ?></td>
            <td><button class="xiafenok" onclick="xiafenok(<?php echo $order->id ?>)">下分完成点击</button></td>
        </tr>
    <?php } ?>
    </tbody>
    <tfoot>
        <td colspan="6" class="text-center">分页</td>
    </tfoot>
</table>
@endsection

@section('jquery')
<script>
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
       
</script>
@endsection