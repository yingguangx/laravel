@extends('staffLayOut')

@section('style')
    <link rel="stylesheet" href="{{URL::asset('js/jquery-ui/jquery-ui.css')}}">
    <link rel="stylesheet" media="all" type="text/css" href="{{URL::asset('js/jquery-ui-timepicker-addon/jquery-ui-timepicker-addon.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('js/bstValidator/css/bootstrapValidator.min.css')}}">
    <style>
        .required{
            color:red;
        }
        #ui-datepicker-div{
            z-index:20000!important;
        }
        .form-control[disabled],.form-control[readonly]{
            background:white!important;
            opacity: 1;
        }
        .tab-pane{
            margin-top:28px;
        }
        .error{
            color:red;
        }

    </style>
@endsection

@section('content')

    {{--tab选项卡--}}
    <div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">奖项设置</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">基础设置</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">

            <div role="tabpanel" class="tab-pane fade in active" id="home">
                <button class="btn btn-primary btn-add" style="margin-bottom:10px">添加奖项</button>
                <section>
                    <table class="table-hover table-striped table-bordered table award_table">
                        <thead>
                        <tr>
                            <th>奖品名称</th>
                            <th>中奖概率(%)</th>
                            <th>当日充值金额(元)</th>
                            <th>送金币(万)</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr data-prize_id="" data-prize_detail_id="">
                                <td>谢谢参与</td>
                                <td>10</td>
                                <td>0</td>
                                <td>0</td>
                                <td>
                                    <button type="submit" class="btn btn-primary thank_edit">修改</button>
                                </td>
                            </tr>
                            @foreach($award_list as $k => $v)
                            <tr prize_id="{{$v['prize_id']}}" prize_detail_id="{{$v['prize_detail_id']}}">
                                <td><div><input style="display: none" type="text" value="{{$v['name']}}" name="name" class="required_val"><span class="val">{{$v['name']}}</div><span class="error hide">不能为空</span></td>
                                <td><div><input style="display: none" type="text" value="{{$v['probability']}}" name="probability" class="percent"><span class="val">{{$v['probability']}}</div><span class="error hide">必须是0-100之间的整数</span></td>
                                <td><div><input style="display: none" type="text" value="{{$v['deposit']}}" name="deposit" class="int"><span class="val">{{$v['deposit']}}</div><span class="error hide">必须是数字</span></td>
                                <td><div><input style="display: none" type="text" value="{{$v['prize']}}" class="int" name="prize"><span class="val">{{$v['prize']}}</div><span class="error hide">必须是数字</span></td>
                                <td>
                                    <button class="btn btn-danger award-delete">删除</button>
                                    <button type="submit" class="btn btn-primary edit-award">修改</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            </div>
            <div role="tabpanel" class="tab-pane fade " id="profile">
                <section class="col-md-10">
                    <form action="{{URL::to('/staff/wheel/base_setting')}}" id="base_setting">
                        {{csrf_field()}}
                        <div class="form-horizontal">
                            <div class="form-group has-feedback">
                                <label for="begintime" class="col-sm-2 control-label"><span class="required">*</span>活动开始时间</label>
                                <div class="col-sm-4">
                                    <input name="start_time" value="{{$base_setting['start_time']}}" readonly style="cursor:pointer;" type="text" class="form-control input-date" id="begintime" placeholder="活动开始时间">
                                    <i class="form-control-feedback glyphicon glyphicon-remove" data-bv-icon-for="start_time" style="display: none"></i>
                                    <small  style="display: none" class="help-block" data-bv-validator="notEmpty" data-bv-for="start_time" data-bv-result="INVALID" style="">开始时间不能为空</small>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="endtime" class="col-sm-2 control-label"><span class="required">*</span>活动结束时间</label>
                                <div class="col-sm-4">
                                    <input  name="finish_time" value="{{$base_setting['finish_time']}}" readonly style="cursor:pointer" type="text" class="form-control input-date" id="endtime" placeholder="活动结束时间">
                                    <i class="form-control-feedback glyphicon glyphicon-ok" data-bv-icon-for="start_time" style="display: none"></i>
                                    <small style="display: none" class="help-block" data-bv-validator="notEmpty" data-bv-for="start_time" data-bv-result="INVALID" style="">结束时间不能为空</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="play_time" class="col-sm-2 control-label"><span class="required">*</span></span>每人每天抽奖次数</label>
                                <div class="col-sm-4">
                                    <input  value="{{$base_setting['play_num']}}" name="play_num" type="text" class="form-control" id="play_time" placeholder="每人每天抽奖次数">
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="play_time" class="col-sm-2 control-label"><span class="required">*</span>活动规则说明</label>
                                <div class="col-md-8 col-sm-8">
                                    <script id="editor" type="text/plain" class="" name="rules"></script>
                                    <i class="glyphicon glyphicon-remove" data-bv-icon-for="start_time" style="display: none;color:#a94442"></i>
                                    <small style="display: none;color:#a94442" class="" data-bv-validator="notEmpty" data-bv-for="start_time" data-bv-result="INVALID" style="">活动规则不能为空</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary btn-save-base">保存</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
@endsection


@section('jquery')
    <script src="{{URL::asset('js/jquery-ui/jquery-ui.js')}}"></script>
    <script src="{{URL::asset('js/jquery-ui/date-picker_zh.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/jquery-ui-timepicker-addon/jquery-ui-timepicker-addon.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/jquery-ui-timepicker-addon/i18n/jquery-ui-timepicker-addon-i18n.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/jquery-ui-timepicker-addon/jquery-ui-sliderAccess.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/bstValidator/js/bootstrapValidator.min.js')}}"></script>
    <script type="text/javascript" charset="utf-8" src="{{URL::asset('js/utf8-php/ueditor.config.js')}}"></script>
    <script type="text/javascript" charset="utf-8" src="{{URL::asset('js/utf8-php/ueditor.all.min.js')}}"> </script>
    <script type="text/javascript" src="{{URL::asset('js/layui/layui.all.js')}}"></script>

    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="{{URL::asset('js/utf8-php/lang/zh-cn/zh-cn.js')}}"></script>
    <script>
        $(function(){
            var WheelSetting = {
                ajaxUrl:{
                    'award_save' : "{{URL::to('/staff/wheel/award_save')}}",
                    'delete'     : "{{URL::to('/staff/wheel/award_delete')}}",
                },
                //初始化
                init:function(){
                    this.bindEvents();
                    this.initUedtior();
                    this.initDatePicker();
                    this.initBaseSettingFormValidator();
                },

                //绑定事件
                bindEvents:function(){
                    $('input.input-date').change($.proxy(this.date_input_change,this));
                    $('.btn-add').click($.proxy(this.addAward));
                    $('tbody').on('change','input',$.proxy(this.input_validate,this));
                    $('tbody').on('click','.save-award',$.proxy(this.click_save_award,this));
                    $('tbody').on('click','.award-delete',$.proxy(this.click_delete_award,this));
                    $('tbody').on('click','.edit-award',$.proxy(this.edit_render,this));

                },

                //点击添加奖项的前端渲染
                addAward:function(){
                        var html = '<tr><td><div><input type="text" name="name" class="required_val"><span class="val"></div><span class="error hide">不能为空</span></td>'+
                            '<td><div><input type="text" name="probability" class="percent"><span class="val"></div><span class="error hide">必须是0-100之间的整数</span></td>'+
                    '<td><div><input type="text" name="deposit" class="int"><span class="val"></div><span class="error hide">必须是数字</span></td>'+
                        '<td><div><input type="text" class="int" name="prize"><span class="val"></div><span class="error hide">必须是数字</span></td>'+
                        '<td>'+
                        '<button class="btn btn-danger award-delete">删除</button>'+
                        '<button type="submit" class="btn btn-primary save-award">保存</button>'+
                        '</td></tr>';
                        $('table.award_table tbody').append(html);
                },


                //保存成功之后的前端渲染
                save_success_render:function(input,data){
                    var val,
                        $tr = input.closest('tr'),
                        btn = $tr.find('.save-award');
                    $tr.attr('prize_id',data.data['prize_id']);
                    $tr.attr('prize_detail_id',data.data['prize_detail_id']);
                    $.each(input,function(){
                        val = $(this).val();
                        $(this).hide().next().html(val).show();
                        btn.removeClass('save-award').addClass('edit-award').removeClass('btn-primary').addClass('btn-info').html('修改');
                    })
                },

                //点击编辑之后的前端渲染
                edit_render:function(e){
                    var $tr = $(e.target).closest('tr'),
                        val,
                        input = $tr.find('input'),
                        btn = $(e.target);
                    $.each(input,function(){
                        val = $(this).val();
                        $(this).show().next().hide();
                        btn.removeClass('edit-award').addClass('save-award').removeClass('btn-info').addClass('btn-primary').html('保存');
                    })
                },

                //点击保存之后的js事件
                click_save_award:function(e){
                    var $target = $(e.target),
                        $tr = $target.closest('tr'),
                        data = {},
                        that = this;
                    $tr.find('input').trigger('change');

                    //没有错误就提交
                    if($tr.find('.error:visible').length==0){

//                        向服务器保存或者修改数据
                        data = this.get_data_from_tr($tr.find('input'));
                        $.post(this.ajaxUrl.award_save,data,function(data){
                            that.infoSuccess('保存成功!');
                            that.save_success_render($tr.find('input'),data);
                        });
                    }
                    return false;
                },

                //点击删除奖项之后的事件
                click_delete_award:function(e){
                    var that  = this,
                        $btn = $(e.target),
                        tr = $btn.closest('tr'),
                        prize_id = tr.attr('prize_id'),
                        prize_detail_id  = tr.attr('prize_detail_id');

                    if(prize_id && prize_detail_id){
                        that.infoConfirm(tr,false,{_token:"{{csrf_token()}}",prize_id:prize_id,prize_detail_id:prize_detail_id});
                    }else{
                        that.infoConfirm(tr,true,null);
                    }

                },

                //从tr中获取input框的值
                get_data_from_tr:function(input){
                    var data = {},
                        tr = input.eq(0).closest('tr');
                    $.each(input,function(k,v){
                        data[$(this).attr('name')] = $(this).val();
                    })
                    if(tr.attr('prize_detail_id')){
                        data['prize_detail_id'] = tr.attr('prize_detail_id');
                    }
                    if(tr.attr('prize_id')){
                        data['prize_id'] = tr.attr('prize_id');
                    }
                    data['_token'] = "{{csrf_token()}}";
                    return data;
                },

                //奖项设置前台验证
                input_validate:function(e){
                    var that = this,
                        $target = $(e.target),
                        $div_container = $target.parent(),
                        input_val =  $target.val();
                    if($target.hasClass('required_val')){
                        if(input_val==''){
                            $div_container.next().removeClass('hide');
                        }else{
                            $div_container.next().addClass('hide');
                        }
                    }

                    if($target.hasClass('percent')){
                        if(/^[0-9]$|^([1-9][0-9])$|^100$/.test(input_val)){
                            $div_container.next().addClass('hide');
                        }else{
                            $div_container.next().removeClass('hide');
                        }
                    }

                    if($target.hasClass('int')){
                        if( /^0$|^[1-9]{1,}[0]*$/.test(input_val)){
                            $div_container.next().addClass('hide')
                        }else{
                            $div_container.next().removeClass('hide');
                        }
                    }

                },

                //检查base_setting Form表单的有效性
                checkValid:function(){
                    if($('#base_setting').find('.glyphicon-remove:visible').length == 0){
                        $('#base_setting .btn-save-base').removeAttr('disabled');
                    }else{
                        $('#base_setting .btn-save-base').attr('disabled','disabled');
                    }
                },

                //初始化富文本编辑器
                initUedtior:function(){
                    var that = this;
                    var ue = UE.getEditor('editor');
                    ue.ready(function() {//编辑器初始化完成再赋值
                        ue.setContent('<?php echo $base_setting['rules'] ?>');  //赋值给UEditor
                    });
                    ue.addListener( 'contentChange', function( editor ) {
                        that.textarea_change();
                    })
                },

                //初始化时间选择器
                initDatePicker:function(){
                    $( ".input-date" ).datetimepicker(
                        $.timepicker.regional['zh-CN']
                    );
                },

                //时间选择框值变化的时候触发的函数
                date_input_change:function(e){
                  $date_input = $(e.target);
                  if($date_input.val()!=''){
                      $date_input.closest('div.form-group').removeClass('has-error').addClass('has-success').find('i').removeClass('glyphicon-remove').addClass('glyphicon-ok').show().end().find('small').hide();
                  }else{
                      $date_input.closest('div.form-group').removeClass('has-success').addClass('has-error').find('i').removeClass('glyphicon-ok').addClass('glyphicon-remove').show().end().find('small').show();
                  }
                    this.checkValid();
                },

                textarea_change:function(){
                    var content = UE.getEditor('editor').getContent();
                    if(content == ''){
                       $('#editor').nextAll().show();
                    }else{
                        $('#editor').nextAll().hide();
                    }
                    this.checkValid();
                },

                //成功提示
                infoSuccess:function(msg){
                    layer.closeAll();
                    layer.msg(msg, {
                        icon: 6,
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    });
                },

                //失败提示
                infoError:function(msg){
                    layer.closeAll();
                    layer.msg(msg, {
                        icon: 5,
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    });
                },

                infoConfirm:function(tr,is_true_delete,data){
                    var that = this;
                    layer.confirm('确认要删除该奖项吗?', {icon: 3, title:'提示'}, function(index){
                        layer.close(index);
                        if(!is_true_delete){
                            $.post(that.ajaxUrl.delete,data,function(data){
                               that.infoSuccess('删除成功!');
                                tr.fadeOut().remove();
                            })
                        }else{
                            tr.fadeOut().remove();
                        }

                    });
                },

                //初始化基础设置表单验证
                initBaseSettingFormValidator:function(){
                    var that = this;
                    $('#base_setting')
                        .bootstrapValidator({
                            message: '开始时间不能为空',
                            feedbackIcons: {
                                valid: 'glyphicon glyphicon-ok',
                                invalid: 'glyphicon glyphicon-remove',
                                validating: 'glyphicon glyphicon-refresh'
                            },
                            fields: {
                                play_num: {
                                    validators: {
                                        notEmpty: {
                                            message: '每人每天抽奖次数不能为空'
                                        },
                                        greaterThan: {
                                            value: 0,
                                            inclusive: false,
                                            message: '每人每天抽奖次数必须大于等于0'
                                        }
                                    }
                                },
                            }
                        })
                        .on('error.form.bv', function(e) {
                            $('.input-date').trigger('change');
                            that.textarea_change();
                        })
                        .on('success.form.bv', function(e) {
                            e.preventDefault();
                            var $form = $(e.target);
                            var bv = $form.data('bootstrapValidator');
                            $('.input-date').trigger('change');
                            that.textarea_change();
                            console.log('error='+$('#base_setting').find('.glyphicon-remove:visible').length);
                            if($('#base_setting').find('.glyphicon-remove:visible').length == 0){
                                $.post($form.attr('action'),$form.serialize(),function(data){
                                    that.infoSuccess(data.msg);
                                });
                            }
                        });
                }

            };

            WheelSetting.init();
        })
    </script>
@endsection