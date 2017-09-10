@extends('layouts.main')

@section('css')
<link rel="stylesheet" href="{{url(elixir("css/user.css"))}}" type="text/css"/>
<link href="{{URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div id="_centent">
        <header>
            <div class="rt-bk">
                <i class="bk"></i>
                <a href="/">
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
                    <span>200</span>
                </li>
                <li class="pt-line">
                    <i class="clt"></i>
                    <p>积分</p>
                    <span>3000</span>
                </li>
                <li>
                    <i class="rcm"></i>
                    <p>卡劵</p>
                    <span>0</span>
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
            <div class="ps-lt ps-xl" style="display: none;">
                <div class="lt-dsb" style="border-bottom: 0;">
                    <p>订单1：2312312312</p>
                </div>
            </div>
            <div class="ps-lt ps-xl" style="display: none;">
                <div class="lt-dsb" style="border-bottom: 0;">
                    <p>订单2：321312312</p>
                </div>
            </div>
            <div class="ps-lt ps-xl" style="display: none;">
                <div class="lt-dsb" style="border-bottom: 0;">
                    <p>订单3:12312312</p>
                </div>
            </div>
            <div class="ps-lt">
                <div class="lt-dsb">
                    <p>优惠抽奖</p>
                    <i class="arr-right"></i>
                </div>
            </div>
            <div class="ps-lt">
                <div class="lt-dsb">
                    <p>领取积分</p>
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
                <div class="lt-dsb cl-bb">
                    <p>我的收款码</p>
                    <i class="arr-right"></i>
                </div>
            </div>
        </section>

        <div class="jg"></div>
    </div>



	<div class="mune">
    	<img src="images/1.png">
      <a href="/"><p>首页</p></a>
    </div>
	<div class="mune">
    	<img src="images/2.png">
        <p>商家</p>
    </div>
	<div class="mune">
    	<img src="images/3.png">
        <p>申请加盟</p>
    </div>
	<div class="mune">
    	<img src="images/4.png">
        <p>个人中心</p>
    </div>

@push('js')
    <script>
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
    </script>
    <script type="text/javascript">
        $('.check-on').click(function(){
            $(this).toggleClass('check-off');
        })
        $('.lt-order').on('click',function () {
            $('.ps-xl').slideToggle();
        })
    </script>
    <script type="text/javascript" src="{{asset('/js/layui/layui.js')}}"></script>
    <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript">
      layui.use('layer',function(){
             window.layer = layui.layer;
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

    </script>
    <script>
    $('#money_hare').click(function(){
        layer.confirm('<div class="row"><input type="text" class="form-control" placeholder="请输入兑换金额数" name="money_for"></div><div class="row" style="margin-top: 10px;color: #777;">请选择收款类型</div><div class="row" style="margin-top:10px"><input type="radio" name="" /><img src="{{URL::asset("images/wx.jpg")}}" width="" height="29vh"  style="margin-left: 2px;"/><input type="radio" name="" />&nbsp;&nbsp<img src="{{URL::asset("images/zfb.jpg")}}" width="" height="25vh" style="margin-left: 9px;margin-top: -5px;" />&nbsp;&nbsp<input type="radio" name="" /><img src="{{URL::asset("images/yhk.png")}}" width="" height="39vh"  style="margin-top: -13px;margin-left: 1px;"/></div>', {
              btn: ['确定','取消'] //按钮
        }, function(){
            var money = $('input[name="money_for"]').val();
            // layer.msg('的确很重要', {icon: 1});
            $.ajax({
               url: "/money_change",
               type: "POST",
               dataType: "json",
               data: {
                'money':money,
               },
                headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               success: function (data) {
                    console.log(data);
                   }
           });
        }, function(){
        layer.msg('也可以这样', {
            time: 20000, //20s后自动关闭
            btn: ['明白了', '知道了']
        });
        });
    })
       
    </script>
@endpush
@endsection