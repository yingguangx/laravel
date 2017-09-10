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
                <section>
                    <table class="table-hover table-striped table-bordered table">
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
                        <tr>
                            <td>充值100元送60W金币</td>
                            <td>30</td>
                            <td>100</td>
                            <td>60</td>
                            <td><button class="btn btn-danger">删除</button></td>
                        </tr>
                        </tbody>
                    </table>
                </section>
            </div>
            <div role="tabpanel" class="tab-pane fade " id="profile">
                <section class="col-md-10">
                    <form action="{{URL::to('/wheel/base_setting')}}" id="base_setting">
                        <div class="form-horizontal">
                            <div class="form-group has-feedback">
                                <label for="begintime" class="col-sm-2 control-label"><span class="required">*</span>活动开始时间</label>
                                <div class="col-sm-4">
                                    <input name="start_time"  readonly style="cursor:pointer;" type="text" class="form-control input-date" id="begintime" placeholder="活动开始时间">
                                    <i class="form-control-feedback glyphicon glyphicon-remove" data-bv-icon-for="start_time" style="display: none"></i>
                                    <small  style="display: none" class="help-block" data-bv-validator="notEmpty" data-bv-for="start_time" data-bv-result="INVALID" style="">开始时间不能为空</small>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="endtime" class="col-sm-2 control-label"><span class="required">*</span>活动结束时间</label>
                                <div class="col-sm-4">
                                    <input name="finish_time" readonly style="cursor:pointer" type="text" class="form-control input-date" id="endtime" placeholder="活动结束时间">
                                    <i class="form-control-feedback glyphicon glyphicon-ok" data-bv-icon-for="start_time" style="display: none"></i>
                                    <small style="display: none" class="help-block" data-bv-validator="notEmpty" data-bv-for="start_time" data-bv-result="INVALID" style="">结束时间不能为空</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="play_time" class="col-sm-2 control-label"><span class="required">*</span></span>每人每天抽奖次数</label>
                                <div class="col-sm-4">
                                    <input name="play_num" type="text" class="form-control" id="play_time" placeholder="每人每天抽奖次数">
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

    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="{{URL::asset('js/utf8-php/lang/zh-cn/zh-cn.js')}}"></script>
    <script>
        $(function(){
            var WheelSetting = {

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
                        });
                }

            };

            WheelSetting.init();
        })
    </script>
@endsection