@extends('staffLayOut')
@section('style')
<style>
.page-title h3{
		margin: 0px;
    font-size: 20px
	}
</style>
@endsection
@section('content')
<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">员工管理-新建员工</h3>
    </div>
   <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                         <div class="form-group row m-t-15">
                                    <label for="" class="control-label col-md-2">交易码：</label>
                                    <div class="col-md-3">
                                        <input id="key" name="key" type="text" class="form-control" placeholder="请输入交易码" >
                                    </div>
                        </div>
                                <div class="form-group row m-t-15">
                                    <label for="" class="control-label col-md-2">充值金额：</label>
                                    <div class="col-md-3">
                                        <input id="money" name="money" type="text" class="form-control" placeholder="请输入充值金额" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class=" col-md-10">
                                        <button id="save" type="button" class="btn btn-info btn-lg">
                                            确认充值
                                        </button>
                                    </div>
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
layui.use('layer',function(){
             window.layer = layui.layer;
      });
$('#save').click(function(){
	var key = $('input[name="key"]').val();
	var money = $('input[name="money"]').val();
	if (key != '' && money != '') {
		 $.ajax({
               url: "/staff/money_insert",
               type: "POST",
               dataType: "json",
               data:{
               	'key':key,
               	'money':money,
               },
               headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               success: function (data) {
	               if (data.result) {
	               		alert('充值成功');
	               		window.location.reload();
	               }
               }
           })
	} else if(key == '') {
		alert('请输入交易码');
            return false;
	} else if(money != '') {
		alert('请输入充值金额');
            return false;
	}
})
</script>
@endsection
