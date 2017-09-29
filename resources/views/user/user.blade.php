@extends('layouts.main')

@section('css')
<link rel="stylesheet" href="{{url(elixir("css/user.css"))}}" type="text/css"/>
<link href="{{URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">
<style>
    .blue {
        color:blue;
    }
    .fl {
        float: left;
    }
    .clear {
        clean:both;
    }
    .select-default {
        background-color: white;
        color: #2F353F;
        font-size: 14px;
        border-radius: 4px;
        border: 1px solid dimgray;
        box-shadow: none;
        height: 20px;
        width: 70%;
    }
    .input-default {
        background-color: white;
        color: #2F353F;
        font-size: 14px;
        border-radius: 4px;
        border: 1px solid dimgray;
        box-shadow: none;
        height: 20px;
        width: 70%;
        padding-left: 5px;
    }
    .input-default1 {
        background-color: white;
        color: #2F353F;
        font-size: 14px;
        border-radius: 4px;
        border: 1px solid dimgray;
        box-shadow: none;
        height: 20px;
        width: 100%;
        padding-left: 5px;
    }
</style>
@endsection

@section('content')
    <div id="_centent">
        <header>
            <div class="rt-bk">
                <i class="bk"></i>
                <a href="javascript:window.history.go(-1)">
                    <p>返回</p>
                </a>
            </div>
            <div class="top-name"><p>个人中心</p></div>
        </header>
        <div class="head">
            <div class="head-img">
                <img src="images/head-img.png">
            </div>
            <div class="head-dsb">
                <p class="dsb-name">{{ $user->name }}</p>
                <p class="dsb-id">nickName</p>
            </div>
        </div>

        <div class="nav">
            <ul>
                <li id='money_hare'>
                    <i class="idt"></i>
                    <p >余额</p>
                    <span>{{ Auth::user()->money }}</span>
                </li>
                <li class="pt-line">
                    <i class="clt"></i>
                    <p>积分</p>
                    <span>{{ Auth::user()->integration}}</span>
                </li>
                <li class="coupons">
                    <i class="rcm"></i>
                    <p>卡劵</p>
                    <span><?= $coupon_count ?></span>
                </li>
            </ul>
        </div>
        <section class="mt-3">
            <div class="ps-lt">
                <div class="lt-dsb lt-order">
                    <p>我的订单</p>
                    <i class="arr-right"></i>
                </div>
            </div>
            @foreach(\Illuminate\Support\Facades\Auth::user()->userOrder as $order)
                @break($loop->index == 3)
                <div class="ps-lt ps-xl" style="display: none;">
                    <div class="lt-dsb">
                        @if($order->type == 1)
                        <p>{{ $order->user->name }}为账号{{ $order->game_account }}上分了{{ $order->money }}元</p>
                        @else
                        <p>{{ $order->user->name }}为账号{{ $order->game_account }}下分了{{ $order->money }}元</p>
                        @endif
                    </div>
                </div>
            @endforeach
            <a href="/user/order">
                <div class="ps-lt ps-xl" style="display: none;">
                    <div class="lt-dsb">
                        <p>更多</p>
                        <i class="arr-right"></i>

                    </div>
                </div>
            </a>
            <div class="ps-lt">
                <div class="lt-dsb">
                    <a href="/wheel">
                        <p>优惠抽奖</p>
                    </a>
                    <i class="arr-right"></i>
                </div>
            </div>
            <div class="ps-lt">
                <div class="lt-dsb">
                 <a href="/user/messages_list">
                    <p>我的消息</p>
                  </a>
                    <i class="arr-right"></i>
                </div>
            </div>
            <div class="ps-lt">
                <div class="lt-dsb">
                    <p>问题帮助</p>
                    <i class="arr-right"></i>
                </div>
            </div>
            <div class="ps-lt keyGen">
                <div class="lt-dsb">
                    <p>我的密钥</p>
                    <i class="arr-right"></i>
                </div>
            </div>
            <div class="ps-lt skm">
                <div class="lt-dsb">
                    <p>我的收款码</p>
                    <i class="arr-right"></i>
                </div>
            </div>
        </section>

        <div class="jg"></div>
    </div>



	{{--<div class="mune">--}}
    	{{--<img src="images/1.png">--}}
      {{--<a href="/"><p>首页</p></a>--}}
    {{--</div>--}}
	{{--<div class="mune">--}}
    	{{--<img src="images/2.png">--}}
        {{--<p>商家</p>--}}
    {{--</div>--}}
	{{--<div class="mune">--}}
    	{{--<img src="images/3.png">--}}
        {{--<p>申请加盟</p>--}}
    {{--</div>--}}
	{{--<div class="mune">--}}
    	{{--<img src="images/4.png">--}}
        {{--<p>个人中心</p>--}}
    {{--</div>--}}
@endsection

@section('jquery')
    <script type="text/javascript" src="{{URL::asset('/js/layui/layui.js')}}"></script>
    <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript">
      layui.use('layer',function(){
               window.layer = layui.layer;
               if ('{{ $user->key }}' == ''){
                  layer.open({
                      offset:'40%',
                      area:'70%',
                      title:'余额',
                      content: '余额可以提现可以上分下分'
                      ,btn: ['确定']
                      ,yes: function(index){
                          layer.open({
                              title:'积分',
                              content: '积分可以提现可以上分下分'
                              ,btn: ['确定']
                              ,yes: function(index){
                                  layer.open({
                                      title:'卡卷',
                                      content: '可以使用卡卷'
                                      ,btn: ['确定']
                                      ,yes: function(index){
                                          layer.close(index)
                                      }
                                  });
                              }
                          });
                      }
                  });
          }
        });
        (function (doc, win) {
            var docEl = doc.documentElement,
                resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
                recalc = function () {
                    var clientWidth = docEl.clientWidth;
                    if (!clientWidth) return;
                    docEl.style.fontSize = 100 * (clientWidth / 750) + 'px';
                };

            if (!doc.addEventListener) return;
            win.addEventListener(resizeEvt, recalc, false);
            doc.addEventListener('DOMContentLoaded', recalc, false);
        })(document, window);
    
        $('.check-on').click(function(){
            $(this).toggleClass('check-off');
        })
        $('.lt-order').on('click',function () {
            $('.ps-xl').slideToggle();
        });
      $('.keyGen').on('click',function () {
        if('{{ $user->key }}' == ''){
          layer.open({
            title:'请输入您的密钥',
            content: '<input type="password" id="keygen" name="key" required lay-verify="required" placeholder="请输入您的密钥" autocomplete="off" class="layui-input">'
            ,btn: ['<p style="font-size: 14px;">确定</p>', '<p style="font-size: 14px;">取消</p>']
            ,yes: function(index, layero){
              if($('#keygen').val() == ''){
                layer.msg('请输入密钥！');
                return false;
              }
              //按钮【按钮一】的回调
              $.ajax({
                type:'post',
                dataType:'json',
                url:'/user/keygen',
                data:{
                  'userID':'{{ $user->id }}',
                  'keygen':$('#keygen').val(),
                  '_token':'{{csrf_token()}}'
                },
                success:function (result) {
                  layer.msg(result.message);
                },
                error:function () {
                  layer.msg('网络连接失败，请稍后再试！');
                }
              })
            },
            btn2: function(index, layero){
              //按钮【按钮二】的回调

              //return false 开启该代码可禁止点击该按钮关闭
            }
            ,cancel: function(){
              //右上角关闭回调

              //return false 开启该代码可禁止点击该按钮关闭
            }
          })
        }else{
          layer.open({
            title: '我的密钥'
            ,content: '我的密钥：<span>{{ $user->key }}</span>',
            btn:['<p style="font-size: 14px;">确定</p>']
          })
        }

      });
      $('.skm').on('click',function () {
          layer.open({
              title:'收款码类型',
              content: '请选择收款码类型'
              ,btn: ['微信收款码', '支付宝收款码']
              ,yes: function(index){
                  if ('{{ Auth::user()->has_wechat_code  }}' == 'true'){
                      layer.open({
                          title:'微信收款码',
                          content: '已经设置收款码，确定要重新设置？'
                          ,btn: ['是的', '查看收款码']
                          ,yes: function(index, layer){
                              location.href = '/user/userInfo?type=1';
                          }
                          ,btn2: function(index){
                              layer.open({
                                  type: 1,
                                  area: '90%',
                                  offset: '100px',
                                  title:'我的收款码',
                                  content: '<img src="/user/wechatCode" width="100%">' //这里content是一个URL，如果你不想让iframe出现滚动条，你还可以content: ['http://sentsin.com', 'no']
                              });
                          }
                          ,cancel: function(){
                              //右上角关闭回调

                              //return false 开启该代码可禁止点击该按钮关闭
                          }
                      });
                  }else{
                      location.href = '/user/userInfo?type=1';
                  }
              }
              ,btn2: function(index){
                  //按钮【按钮二】的回调
                  if ('{{ Auth::user()->has_zfb_code  }}' == 'true'){
                      layer.open({
                          title:'支付宝收款码',
                          content: '已经设置收款码，确定要重新设置？'
                          ,btn: ['是的', '查看收款码']
                          ,yes: function(index, layer){
                              location.href = '/user/userInfo?type=2';
                          }
                          ,btn2: function(index){
                              layer.open({
                                  type: 1,
                                  area: '90%',
                                  offset: '100px',
                                  title:'我的收款码',
                                  content: '<img src="/user/zfbCode" width="100%">' //这里content是一个URL，如果你不想让iframe出现滚动条，你还可以content: ['http://sentsin.com', 'no']
                              });
                          }
                          ,cancel: function(){
                              //右上角关闭回调

                              //return false 开启该代码可禁止点击该按钮关闭
                          }
                      });
                  }else{
                      location.href = '/user/userInfo?type=2';
                  }
              }
              ,cancel: function(){
                  //右上角关闭回调

                  //return false 开启该代码可禁止点击该按钮关闭
              }
          });
      })

    // function xuanzeyh()
    // {
    //     $('.zfbafter').html('');
        
    // }
    function morenfangshi()
    {
        $('input[name="zfname"]:checked').click();
    }
    function shuruzhanghu()
    {
        var html = '<span style="color:red;">确认兑换后，可在个人中心->我的消息列表中查看</span><span style="color:blue;" onclick="morenfangshi()">使用收款码方式</span>';
        var html2 = '<div class="row zfbafter"><input type="text" class="form-control" placeholder="请输入您的支付宝账号" name="zfb_number"><input type="text" class="form-control" placeholder="请输入您的支付宝姓名" name="zfb_name"></div>';
         $('.zhifuappend').html(html);
         $('.zhifuappend').after(html2);
    }
    function zfselect()
    {
        var html="";
        $('.zhifuappend').html(html);
        $('.zfbafter').html(html);
       if ($('input:radio[name="zfname"]:checked').val() == '微信') {
        $.ajax({
               url: "/judgewx",
               type: "POST",
               dataType: "json",
               data:{

               },
                headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               success: function (data) {
                   if (data.wxewm == null) {
                    var html = '<span style="color:red;" class="wechatsubmitjudge" judge="no">小提示：个人中心上传您的微信收款码，收钱更方便</span>';
                    $('.zhifuappend').html(html);
                   } else {
                     var html = '<span style="color:red;" class="wechatsubmitjudge" judge="yes">小提示：微信收款码已上传，兑换后请注意查</span>';
                    $('.zhifuappend').html(html);
                   }
                }
           });
       }
        if ($('input:radio[name="zfname"]:checked').val() == '支付宝') {
            $.ajax({
               url: "/judgezfb",
               type: "POST",
               dataType: "json",
               data:{

               },
                headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               success: function (data) {
                   if (data.zfbewm == null) {
                    var html = '<span style="color:red;" class="zfbsubmitjudge" judge="no">小提示：到个人中心上传支付宝收款码收钱更方便哦！</span>';
                    var html2 = '<div class="row zfbafter"><input type="text" class="form-control" placeholder="请输入您的支付宝账号" name="zfb_number"><input type="text" class="form-control" placeholder="请输入您的支付宝姓名" name="zfb_name"></div>';
                    $('.zhifuappend').html(html);
                    $('.zhifuappend').after(html2);
                   } else {
                     var html = '<span style="color:red;" class="zfbsubmitjudge" judge="yes">小提示：支付宝收款码已上传,用其它账号收款请手动输入账户</span><span onclick="shuruzhanghu()" style="color:blue;">手动输入账户</span>';

                    $('.zhifuappend').html(html);
                   }
                }
           });
        }

        if ($('input:radio[name="zfname"]:checked').val() == '银行卡') {
            var html = '<label class="col-sm-2 control-label">银行卡类型：</label><select class="form-control" name="yhksort" "><option value="工商银行">工商银行</option><option value="招商银行">招商银行</option><option value="农业银行">农业银行</option><option value="建设银行">建设银行</option><option value="中国银行">中国银行</option><option value="交通银行">交通银行</option></select>';
            var html2 = '<div class="row zfbafter"><input type="text" class="form-control" placeholder="请输入您的银行卡卡号" name="yhk_number"><input type="text" class="form-control" placeholder="请输入银行卡姓名" name="yhk_name"></div>';
         $('.zhifuappend').after(html2);
            $('.zhifuappend').html(html);
        }


    }

    $('.coupons').click(function(){
        location.href = '<?= \Illuminate\Support\Facades\URL::to('/coupons/index')?>';
    })
    $('#money_hare').click(function(){
        layer.confirm('<div class="row"><input type="text" class="form-control" placeholder="请输入兑换金额数" name="money_for"></div><div class="row" style="margin-top: 10px;color: #777;">请选择收款类型</div><div class="row" style="margin-top:10px"><input type="radio" name="zfname" value="微信" / onclick="zfselect()"><img src="{{URL::asset("images/wx.jpg")}}" width="" height="29vh"  style="margin-left: 2px;"/><input type="radio" name="zfname" value="支付宝" onclick="zfselect()"/>&nbsp;&nbsp<img src="{{URL::asset("images/zfb.jpg")}}" width="" height="25vh" style="margin-left: 9px;margin-top: -5px;" />&nbsp;&nbsp<input type="radio" name="zfname" value="银行卡" onclick="zfselect()" /><img src="{{URL::asset("images/yhk.png")}}" width="" height="39vh"  style="margin-top: -13px;margin-left: 1px;"/></div><div class="row zhifuappend" style="margin-top:10px"></div>', {
              btn: ['确认兑换','取消'] //按钮
        }, function(){
            var money = $('input[name="money_for"]').val();
            var gather_sort = $('input[name="zfname"]:checked').val();
            var gather_account = "";
            var gather_name = "";
            if (gather_sort != '微信' && gather_sort != '支付宝' && gather_sort != '银行卡') {
                layer.confirm('请选择收款方式', {
                          btn: ['我知道了'] //按钮
                        });
                return false;
            }

            if (money == '') {
              layer.confirm('请输入兑换金额', {
                          btn: ['我知道了'] //按钮
                        });
                        return false;

            }
            if (gather_sort == '微信') {
                if ($('.zhifuappend').find('.wechatsubmitjudge').attr('judge') == 'no') {
                        layer.confirm('请到个人中心上传您个人微信收款码，或选择其它收款方式', {
                          btn: ['我知道了'] //按钮
                        });
                        return false;

                    }
                
            }
            if (gather_sort == '支付宝') {
                if($('.zfbsubmitjudge').attr('judge') == 'no'){
                  if(typeof($('input[name="zfb_number"]').val()) == "undefined"){
                    layer.confirm('未上传支付宝收款码，请手动输入支付宝账号', {
                          btn: ['我知道了'] //按钮
                        });
                        return false;
                  } else if( $('input[name="zfb_number"]').val() == '' ){
                    layer.confirm('支付宝账号不能为空', {
                          btn: ['我知道了'] //按钮
                        });
                        return false;
                  } else if($('input[name="zfb_name"]').val() == '') {
                     layer.confirm('支付宝姓名不能为空', {
                          btn: ['我知道了'] //按钮
                        });
                        return false;
                  } else {
                    gather_account = $('input[name="zfb_number"]').val();
                    gather_name = $('input[name="zfb_name"]').val();
                  }
                } else {
                  if ($('input[name="zfb_number"]').val() != '' && typeof($('input[name="zfb_number"]').val()) != 'undefined') {
                     gather_account = $('input[name="zfb_number"]').val();
                  }
                   if ($('input[name="zfb_name"]').val() != '' && typeof($('input[name="zfb_name"]').val()) != 'undefined') {
                     gather_name = $('input[name="zfb_name"]').val();
                  }
                }
            }
            if (gather_sort == '银行卡') {
              if ($('input[name="yhk_number"]').val() == '') {
                layer.confirm('银行卡卡号不能为空', {
                          btn: ['我知道了'] //按钮
                        });
                        return false;
              } else if($('input[name="yhk_name"]').val() == ''){
                layer.confirm('持卡者姓名不能为空', {
                          btn: ['我知道了'] //按钮
                        });
                        return false;
              } else {
                gather_account = $('input[name="yhk_number"]').val();
                gather_name = $('input[name="yhk_name"]').val();
              }
            }
            // layer.msg('的确很重要', {icon: 1});
            $.ajax({
               url: "/money_change",
               type: "POST",
               dataType: "json",
               data: {
                'money':money,
                'gather_sort':gather_sort,
                'gather_account':gather_account,
                'gather_name':gather_name,
               },
                headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               success: function (data) {
                      if(data.result1){
                        layer.confirm('兑换成功', {
                          btn: ['我知道了'] //按钮
                        });
                           window.location.reload();
                      } else {
                        layer.confirm(data.issue, {
                          btn: ['我知道了'] //按钮
                        });
                        return false;
                      }
                   }
           });
        }, function(){
        
        });
    })

    //积分兑换
        $('.pt-line').click(function () {
            var _this = $(this);
            var value = $(this).children('span').html();
            //获取积分兑换规则 及游戏类目
            $.ajax({
                url: "/getIntegrationInfo",
                type: "get",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data) {
                        var content =
                                '<div>'
                                +'<span><span style="color: black;font-size: 16px;">兑换准则:</span>您当前积分余额<span class="blue">'+value+'</span>，<span class="blue">'+data['start_value']+'</span>积分起兑，每<span class="blue">'+data['start_value']+'</span>积分可兑换<span class="blue">'+data['get_value']+'万</span>游戏分值。祝您游戏愉快！</span>'
                                +'</div>'

                                +'<div style="margin-left: 20px">'
                                +'<div style="margin-top: 10px;">'
                                +'<div style="width: 40%;text-align: right" class="fl">'
                                +'<span>游戏类目选择<span style="color:red;">*</span>：</span>'
                                +'</div>'
                                +'<div style="width: 60%;" class="fl">'
                                +'<select id="gameId" class="select-default demo">'
                                +'<option value="">请选择游戏种类</option>';
                        $.each(data['game'], function (i, item) {
                            content+= '<option value="'+item['id']+'">'+item['name']+'</option>';
                        })

                        content+= '</select>'
                                +'</div>'
                                +'<div class="clear"></div>'
                                +'</div>'
                                +'<div style="margin-top: 15px;">'
                                +'<div style="width: 40%;margin-top: 5px;text-align: right" class="fl">'
                                +'<span>游戏账号填写<span style="color:red;">*</span>：</span>'
                                +'</div>'
                                +'<div style="width: 60%;margin-top: 5px;" class="fl">'
                                +'<input class="input-default demo" type="text" id="account" placeholder="请填写游戏账号">'
                                +'</div>'
                                +'<div class="clear"></div>'
                                +'</div>'
                                +'<div style="margin-top: 15px;">'
                                +'<div style="width: 40%;margin-top: 5px;text-align: right" class="fl">'
                                +'<span>积分数额填写<span style="color:red;">*</span>：</span>'
                                +'</div>'
                                +'<div style="width: 60%;margin-top: 5px;" class="fl">'
                                +'<input class="input-default demo" type="text"  id="value" placeholder="积分数额">'
                                +'</div>'
                                +'<div class="clear"></div>'
                                +'</div>'
                                +'<div style="margin-top: 15px;display: none" id="notice">'
                                +'<div style="width: 100%;margin-top: 5px;margin-left: 17px" class="fl">'
                                +'<span style="color:red;">请将带*选项填写完毕！</span>'
                                +'</div>'
                                +'<div class="clear"></div>'
                                +'</div>'
                                +'</div>';

                        layer.confirm(content, {
                            btn: ['取消','确定兑换']
                        }, function(){
                            layer.closeAll('dialog');
                        }, function(){
                            var game = $('#gameId').val();
                            var account = $('#account').val();
                            var t_value = $('#value').val();

                            if (game == '' || account == '' || t_value == '') {
                                $('#notice').show();
                                return false;
                            }
                            $.ajax({
                                url: "/newIntegrationOrder",
                                type: "POST",
                                dataType: "json",
                                data: {
                                    'game_id':game,
                                    'game_account':account,
                                    'value':t_value
                                },
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function (data) {
                                    if (data['status'] == 1) {
                                        _this.children('span').html((Number(value)-Number(t_value)).toFixed(2));
                                        layer.msg('兑换成功,游戏房间号为 '+data['number']+'！');
                                    }else if (data['status'] == 2) {
                                        layer.msg('兑换失败,'+data['msg']+'积分起兑！');
                                    }else if(data['status'] == 4){
                                        layer.msg('兑换失败，暂时您的积分为0！');
                                    }else {
                                        layer.msg('兑换失败,当前积分不足请核实后再兑换！');
                                    }
                                }
                            });
                        });
                    } else {
                        layer.msg('系统参数暂未设置！');
                    }
                }
            });
        });
    </script>
@endsection
