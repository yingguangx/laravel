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
    <div class="row m-l-15 m-t-15">
        <span class="font-title m-l-15" style="font-size: 15px">余额充值</span>
    </div>

    <div class="row m-l-15 m-t-15">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="form-group row m-t-15">
                        <span style="text-align: right" class="control-label col-md-2 m-t-5">交易码：</span>
                        <div class="col-md-3">
                            <input id="key" name="key" type="text" class="form-control" placeholder="请输入交易码" >
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group row m-t-15">
                        <span  style="text-align: right" class="control-label col-md-2 m-t-5">充值金额：</span>
                        <div class="col-md-3">
                            <input id="money" name="money" type="text" class="form-control" placeholder="请输入充值金额" >
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-2 col-md-offset-2 m-t-15">
                            <button id="save" type="button" class="btn btn-info btn-lg">
                                确认充值
                            </button>
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
	               		layer.msg('充值成功',{time:1500});
	               		window.location.reload();
	               } else {
                       layer.msg('对不起您输入的交易码不存在！');
                   }
               }
           })
	} else if(key == '') {
		layer.msg('请输入交易码');
            return false;
	} else if(money == '') {
		layer.msg('请输入充值金额');
            return false;
	}
})
</script>
@endsection
