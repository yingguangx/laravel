@extends('staffLayOut')

@section('content')
    <div class="wraper container-fluid">
        <div class="page-title">
            <h3 class="title">游戏类型管理</h3>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
					<div class="row">
                            <div class="col-md-12 m-t-15">
                            	<div class="col-md-5">
                                    <button type="button"  class="btn btn-info addgamesort"  data-toggle="modal" data-target="#addgamesort">
                                        添加游戏种类
                                    </button>
                                </div>
                            </div>
                    </div>
     				</div>
     					<!-- modal-start -->
	<!-- Modal -->
		<div class="modal fade" id="addgamesort" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">添加游戏种类</h4>
		      </div>
		      <div class="modal-body">
		        <form method="post" action="/staff/saveGame">
        			{{ csrf_field() }}
				  <div class="form-group">
				    <label for="exampleInputEmail1">游戏名称</label>
				    <input type="text" class="form-control" placeholder="游戏名称" name="game_name">
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">游戏上分比例（分数除以人民币）</label>
				    <input type="text" class="form-control" placeholder="游戏比例" name="up_rate">
				  </div>
				   <div class="form-group">
				    <label for="exampleInputPassword1">游戏下分比例（分数除以人民币）</label>
				    <input type="text" class="form-control" placeholder="游戏比例" name="down_rate">
				  </div>
				  <div class="form-group">
				    <label for="exampleInputFile">商家游戏ID</label>
				    <input type="text" class="form-control" placeholder="商家游戏ID" name="business_id">
				  </div>
				  <div class="form-group">
				    <label for="exampleInputFile">游戏币每亿成本价</label>
				    <input type="text" class="form-control" placeholder="游戏币每亿成本价" name="cost_price">
				  </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
		        <button type="submit savegame" class="btn btn-primary">保存</button>
		      </div>
				</form>
		    </div>
		  </div>
		</div>
	<!-- modal-end -->
	<!-- Modal -update-->
		<div class="modal fade" id="upgamesort" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">添加游戏种类</h4>
		      </div>
		      <div class="modal-body">
		        <form method="post" action="/staff/saveupGame">
        			{{ csrf_field() }}
        			<input type="hidden" name="gameid" value="">
				  <div class="form-group">
				    <label for="exampleInputEmail1">游戏名称</label>
				    <input type="text" class="form-control" placeholder="游戏名称" name="game_name_up">
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">游戏上分比例（分数除以人民币）</label>
				    <input type="text" class="form-control" placeholder="游戏比例" name="up_rate_up">
				  </div>
				   <div class="form-group">
				    <label for="exampleInputPassword1">游戏下分比例（分数除以人民币）</label>
				    <input type="text" class="form-control" placeholder="游戏比例" name="down_rate_up">
				  </div>
				  <div class="form-group">
				    <label for="exampleInputFile">商家游戏ID</label>
				    <input type="text" class="form-control" placeholder="商家游戏ID" name="business_id_up">
				  </div>
				   <div class="form-group">
				    <label for="exampleInputFile">游戏币每亿成本价</label>
				    <input type="text" class="form-control" placeholder="游戏币每亿成本价" name="price_cost_up">
				  </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
		        <button type="submit saveupgame" class="btn btn-primary">保存</button>
		      </div>
				</form>
		    </div>
		  </div>
		</div>
	<!-- modal-end -->
     				 <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="datatable_wrapper"
                                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                    <div class="row" style="overflow-X:scroll">
                                        <div class="col-sm-12">
                                            <table id="datatable"
                                                   class="table table-striped table-bordered dataTable no-footer"
                                                   role="grid" aria-describedby="datatable_info">
                                                <thead>
                                                <tr role="row">
                                                    <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Office: activate to sort column ascending">游戏名称
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Office: activate to sort column ascending">游戏上分比例
                                                    </th>
                                                     <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Office: activate to sort column ascending">游戏下分比例
                                                    </th>
                                                   
                                                    <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Age: activate to sort column ascending">商家的游戏ID（用于下分）
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Age: activate to sort column ascending">游戏币每亿成本价
                                                    </th>
                                                     <th class="sorting" tabindex="0" aria-controls="datatable"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Age: activate to sort column ascending">操作
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($games as $key => $game) {
                                                ?>
                                                <tr role="row" class="odd">
                                                <td class="hidden gameid"><?php echo $game->id ?></td>
                                                    <td class="game_name"><?php echo $game->name ?></td>
                                                    <td class="game_up_rate"><?php echo $game->up_rate ?></td>
                                                    <td class="game_hhwx_rate"><?php echo $game->hhwx_rate ?></td>
                                                    <td class="game_business_id"><?php echo $game->business_id ?></td>
                                                    <td class="price_cost_up"><?php echo $game->cost_price ?></td>
                                                    <td><a class="btn btn-danger" href='{{ URL("staff/delGame/$game->id") }}'>删除</a><button class="btn btn-primary upgamesort" data-toggle="modal" data-target="#upgamesort">修改</button></td>
                                                </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                              <!--  -->
                                  <!-- s -->
     			</div>
     		</div>
     	</div>
     	</div>
@endsection

@section('jquery')
<script>
$(document).ready(function(){
	$('.addgamesort').click(function(){
		$('input[name="game_name"]').val('');
		$('input[name="down_rate"]').val('');
		$('input[name="business_id"]').val('');
		$('input[name="up_rate"]').val('');
	});

	$('.upgamesort').click(function(){
		var gameid = $(this).parent().parent().find('.gameid').text();
		var game_name = $(this).parent().parent().find('.game_name').text();
		var game_up_rate = $(this).parent().parent().find('.game_up_rate').text();
		var game_hhwx_rate = $(this).parent().parent().find('.game_hhwx_rate').text();
		var game_business_id = $(this).parent().parent().find('.game_business_id').text();
		var price_cost_up = $(this).parent().parent().find('.price_cost_up').text();
		$('input[name="game_name_up"]').val(game_name);
		$('input[name="down_rate_up"]').val(game_hhwx_rate);
		$('input[name="business_id_up"]').val(game_business_id);
		$('input[name="up_rate_up"]').val(game_up_rate);
		$('input[name="gameid"]').val(gameid);
		$('input[name="price_cost_up"]').val(price_cost_up);
	})
})
</script>
@endsection
