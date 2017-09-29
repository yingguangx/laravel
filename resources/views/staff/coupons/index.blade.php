@extends('staffLayOut')

@section('style')
    <link rel="stylesheet" href="{{URL::asset('js/bstValidator/css/bootstrapValidator.min.css')}}">
    <style>
        .required{
            color:red;
        }
        #ui-datepicker-div{
            z-index:20000!important;
        }
        .error{
            color:red;
        }
        .ok{
            color:green;
        }
        form{
            margin-top:30px;
        }
    </style>
@endsection
@section('content')

    <div class="container-fluid">
        <h3>优惠券设置</h3>
        <form action="" class="form-horizontal">
            {{csrf_field()}}
            <div class="form-group has-feedback">
                <label for="begintime" class="col-sm-2 control-label"><span class="required"></span>卡券有效时间(天)</label>
                <div class="col-sm-4">
                    <input name="valid_time" value="<?php echo $wheel_model['valid_time']?>" style="" type="text" class="form-control input-date" id="begintime" placeholder="活动开始时间">
                    <i class="error form-control-feedback glyphicon glyphicon-remove" data-bv-icon-for="start_time" style="display: none"></i>
                    <small  style="display: none" class="error help-block" data-bv-validator="notEmpty" data-bv-for="start_time" data-bv-result="INVALID" style="">有效时间必须是数字</small>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                    <button class="btn btn-primary btn-save">保存</button>
                </div>
            </div>
        </form>
    </div>

@endsection


@section('jquery')
    <script type="text/javascript" src="{{URL::asset('js/bstValidator/js/bootstrapValidator.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/layui/layui.all.js')}}"></script>

    <script>
        $(function(){
            var coupons_setting = {

                ajaxUrl:{
                  'coupons_setting' : '/staff/coupons/setting',
                },
                //初始化配置
                init:function(){
                    this.bindEvents();
                },

                //绑定事件
                bindEvents:function(){
                    $('form').submit($.proxy(this.form_submit,this));
                },

                form_submit:function(e){
                    var $form = $(e.target),
                        that  = this,
                        $valid_time_input = $form.find('input[name="valid_time"]');
                    e.preventDefault();
                    if(!/^0$|^[1-9][0-9]*$/.test($valid_time_input.val())){
                       this.showMess($valid_time_input,false);
                       return false;
                    }else{
                        this.showMess($valid_time_input,true);
                        //传输数据
                        $('.btn-save').attr('disabled',true);
                        $.post(this.ajaxUrl.coupons_setting,$form.serialize(),function(data){
                            that.infoSuccess(data.msg);
                            $('.btn-save').attr('disabled',false);
                        });
                    }
                },

                //显示错误信息
                showMess:function(input,is_valid){
                    if(is_valid){
                        input.next().removeClass('glyphicon-remove error').addClass('glyphicon-ok ok').show().next().hide();
                    }else{
                        input.next().removeClass('glyphicon-ok ok').addClass('glyphicon-remove error').show().next().show();
                    }
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
            }

            coupons_setting.init();
        })
    </script>
@endsection