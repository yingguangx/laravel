@extends('staffLayOut')

@section('content')
    <div class="wraper container-fluid">
    	<div class="page-title">
            <h3 class="title">系统管理-杂货个清重量档运费设置</h3>
        </div>
         <div class="row">
           	<div class="col-lg-12">
	            <div class="panel panel-defaul">
	            <div class="panel-heading">
				<div>
					<ul class="nav nav-tabs" role="tablist" id="tab_dang">
				    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">重量档参数设置</a></li>
				    <li role="presentation"  ><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">重量档运费设置</a></li>
				  </ul>
				  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
                                   <div class="form-group m-t-15">
                                       <div class="col-md-9 col-md-offset-2 data-list-weight">
                                           <div class="row">
                                               <div class="col-md-offset-1 col-md-2">
                                                   <h5>北极星重量档显示（KG）</h5>
                                               </div>
                                               <div class="col-md-2 col-md-offset-1">
                                                   <h5>最小重量（g）</h5>
                                               </div>
                                               <div class="col-md-2 col-md-offset-1">
                                                   <h5>最大重量（g）</h5>
                                               </div>
                                           </div>
                                           @foreach($polweights as $polweight)
                                               <div class="row m-t-15">
                                                   <div class="col-md-3">
                                                       <div class="row">
                                                           <span class="col-md-2 clh" id="polweight_{{$polweight['id']}}">{{$polweight['id']}}</span>
                                                           <div class="col-md-10">
                                                               <input type="text" class="form-control" value="{{$polweight['weight_show']}}">
                                                           </div>
                                                       </div>
                                                   </div>
                                                   <div class="col-md-3">
                                                       <input type="text" class="form-control" value="{{$polweight['min_weight']}}">
                                                   </div>
                                                   <div class="col-md-3">
                                                       <input type="text" class="form-control" value="{{$polweight['max_weight']}}">
                                                   </div>
                                                   <div class="col-md-3">
                                                       <button type="button" class="btn btn-inverse m-b-5" onclick="deletepolweight($(this),{{$polweight['id']}})">删除</button>
                                                   </div>
                                               </div>
                                           @endforeach
                                        <form class="form-horizontal sys_6" id="weight_add_form" method="post" action="/staff/zhgqCreatePolWeight">
                                        {{ csrf_field() }}
                                           <div class="row m-t-15">
                                               <div class="col-md-3">
                                                   <div class="row">
                                                       <span class="col-md-2 clh"></span>
                                                       <div class="col-md-10">
                                                           <input type="text" id="pweight_show" name="pweight_show" class="form-control">
                                                       </div>
                                                   </div>
                                               </div>
                                               <div class="col-md-3">
                                                   <input type="text" id="pmin_weight" name="pmin_weight" class="form-control">
                                               </div>
                                               <div class="col-md-3">
                                                   <input type="text" id="pmax_weight" name="pmax_weight" class="form-control">
                                               </div>
                                               <div class="col-md-3">
                                                   <button type="button" class="btn btn-info m-b-5" onclick="addpolweight()">保存</button>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </form>
    </div>
    <!-- s -->
				</div>
				</div>
				</div>
			</div>
    </div>
@endsection

@section('jquery')
@endsection