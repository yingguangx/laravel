<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>大转盘抽奖活动</title>
<link href="{{URL::asset('css/zp_style.css')}}" rel="stylesheet" />
<link href="{{URL::asset('css/style.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{URL::asset('css/weui.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/jquery-weui.css')}}">

<script type="text/javascript" src="{{URL::asset('js/jquery-1.8.0.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/jQueryRotate.2.2.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/awardRotate.js')}}"></script>
<script src="{{URL::asset('js/jquery-weui.js')}}"></script>


<script type="text/javascript">
$(function(){
	//多行应用@Mr.Think
	var _wrap=$('ul.mulitline');//定义滚动区域
	var _interval=2000;//定义滚动间隙时间
	var _moving;//需要清除的动画
	_wrap.hover(function(){
		clearInterval(_moving);//当鼠标在滚动区域中时,停止滚动
	},function(){
	    if(_wrap.find('li').length<=6){
	        return false;
        }
		_moving=setInterval(function(){
			var _field=_wrap.find('li:first');//此变量不可放置于函数起始处,li:first取值是变化的
			var _h=_field.height();//取得每次滚动高度
			_field.animate({marginTop:-_h+'px'},600,function(){//通过取负margin值,隐藏第一行
				_field.css('marginTop',0).appendTo(_wrap);//隐藏后,将该行的margin值置零,并插入到最后,实现无缝滚动
			})
		},_interval)//滚动间隔时间取决于_interval
	}).trigger('mouseleave');//函数载入时,模拟执行mouseleave,即自动滚动
});


</script>
</head>
<body>
<!--<div class="letter_mian">
  <p class="ban_date"><span>活动时间</span><strong>：</strong>2014年10月15日-2014年11月10日</p>
</div>-->
<div class="con_chouj">
  <div class="chou_box">
    <img src="{{URL::asset('image/coupons/1.png')}}" id="shan-img" style="display:none;" />
    <img src="{{URL::asset('image/coupons/2.png')}}" id="sorry-img" style="display:none;" />
    <div class="banner">
      <div class="turnplate" style="background-image:url({{URL::asset('image/coupons/turnplate-bg.png')}});background-size:100% 100%;">
        <canvas class="item" id="wheelcanvas" width="422px" height="422px"></canvas>
        <img class="pointer" src="{{URL::asset('image/coupons/turnplate-pointer.png')}}"/>
      </div>
    </div>

  </div>
  <div class="win_open"> 
    <!-- 中奖列表begin -->
    <div class="win_box">
      <h2 class="win_tit">中奖英雄榜</h2>
      <div class="win_cont">
        <div class="win_scroll" id="lottery_list_container_0">
          <div class="win_height">
            <div id="demo">
              <ul class="win_list mulitline">
                @foreach($luck_list as $k => $v)
                <li><span class="txt"><font>{{$v['name']}}</font></span><strong class="num">{{$v['nickName']}}</strong></li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- 中奖列表end --> 
  </div>
</div>
<div class="letter_mian4">
  <div class="invite_title">
    <h3 class="invite_title_l"></h3>
    <span class="fh_top"> <a href="#top" target="_self" title="返回顶部"><img src="images/ic_top.png" /></a></span></div>
  <div class="rules_presented_box" style="border-left:none;height:auto;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="invite_table">
      <tr>
        <th width="50%" scope="col" align="center">奖品序号</th>
        <th width="50%" scope="col" align="center">奖品</th>
      </tr>
      @foreach($award_list as $k => $v)
      <tr>
        <td align="center">{{$k+1}}</td>
        <td align="center">{{$v['name']}}</td>
      </tr>
      @endforeach
    </table>
  </div>
  <div class="clear"></div>
</div>
<div class="Activities">
  <h1><span class="fh_top2"> <a href="#top" target="_self" title="返回顶部"><img src="images/ic_top.png" /></a></span><img src="images/Activities_09.jpg" width="146" height="35" alt=""/></h1>
  <div class="ate_box">
    {{$rules}}
  </div>
</div>
</body>
<script type="text/javascript">
    var turnplate={
        restaraunts:[],				//大转盘奖品名称
        colors:[],					//大转盘奖品区块对应背景颜色
        outsideRadius:192,			//大转盘外圆的半径
        textRadius:155,				//大转盘奖品位置距离圆心的距离
        insideRadius:68,			//大转盘内圆的半径
        startAngle:0,				//开始角度
        bRotate:false				//false:停止;ture:旋转
    };

    $(document).ready(function(){
        var new_luck_list ;
        $.get("<?= Route('wheel.award')?>",{},function(data){
            if(data.code==400){
                $.alert(data.msg);
                return false;
            }
            turnplate.restaraunts = data.data.restaraunts;
            turnplate.colors = data.data.color;
            drawRouletteWheel();
        });


        var rotateTimeOut = function (){
            $('#wheelcanvas').rotate({
                angle:0,
                animateTo:2160,
                duration:8000,
                callback:function (){
                    alert('网络超时，请检查您的网络设置！');
                }
            });
        };

        //旋转转盘 item:奖品位置; txt：提示语;
        var rotateFn = function (item, txt){
            var angles = item * (360 / turnplate.restaraunts.length) - (360 / (turnplate.restaraunts.length*2));
            if(angles<270){
                angles = 270 - angles;
            }else{
                angles = 360 - angles + 270;
            }
            $('#wheelcanvas').stopRotate();
            $('#wheelcanvas').rotate({
                angle:0,
                animateTo:angles+1800,
                duration:5000,
                callback:function (){
                    if(new_luck_list!=''){
                        var list = new_luck_list;
                        var html = '<li><span class="txt"><font>'+list.name+'</font></span><strong class="num">'+list.nickName+'</strong></li>';
                        $('ul.mulitline').append(html);
                        $.alert('恭喜你中了'+txt+'的卡券,可在个人中心我的卡券页面查看并使用');
                        $('ul.mulitline').trigger('mouseleave');
                    }else{
                        $.alert(txt);
                    }
                    turnplate.bRotate = !turnplate.bRotate;
                }
            });
        };

        $('.pointer').click(function (){
            if(turnplate.bRotate)return;
            turnplate.bRotate = !turnplate.bRotate;
            var item;
            $.ajax({
                async: false,
                url  : "<?= Route('wheel.award_random') ?>",
                type : 'GET',
                success:function(data){
                    item = data.data.item;
                    if(data.code==400){
                        $.alert(data.msg,function(){
                            turnplate.bRotate=false;
                        });
                        return false;
                    }
                    new_luck_list = data.data.new_luck_list;
                    //奖品数量等于10,指针落在对应奖品区域的中心角度[252, 216, 180, 144, 108, 72, 36, 360, 324, 288]
                    rotateFn(item, turnplate.restaraunts[item-1]);
                }
            });


        });
    });

    function rnd(n, m){
        var random = Math.floor(Math.random()*(m-n+1)+n);
        return random;

    }

    function drawRouletteWheel() {
        var canvas = document.getElementById("wheelcanvas");
        if (canvas.getContext) {
            //根据奖品个数计算圆周角度
            var arc = Math.PI / (turnplate.restaraunts.length/2);
            var ctx = canvas.getContext("2d");
            //在给定矩形内清空一个矩形
            ctx.clearRect(0,0,422,422);
            //strokeStyle 属性设置或返回用于笔触的颜色、渐变或模式
            ctx.strokeStyle = "#FFBE04";
            //font 属性设置或返回画布上文本内容的当前字体属性
            ctx.font = '16px Microsoft YaHei';
            for(var i = 0; i < turnplate.restaraunts.length; i++) {
                var angle = turnplate.startAngle + i * arc;
                ctx.fillStyle = turnplate.colors[i];
                ctx.beginPath();
                //arc(x,y,r,起始角,结束角,绘制方向) 方法创建弧/曲线（用于创建圆或部分圆）
                ctx.arc(211, 211, turnplate.outsideRadius, angle, angle + arc, false);
                ctx.arc(211, 211, turnplate.insideRadius, angle + arc, angle, true);
                ctx.stroke();
                ctx.fill();
                //锁画布(为了保存之前的画布状态)
                ctx.save();

                //----绘制奖品开始----
                ctx.fillStyle = "#E5302F";
                var text = turnplate.restaraunts[i];
                var line_height = 17;
                //translate方法重新映射画布上的 (0,0) 位置
                ctx.translate(211 + Math.cos(angle + arc / 2) * turnplate.textRadius, 211 + Math.sin(angle + arc / 2) * turnplate.textRadius);

                //rotate方法旋转当前的绘图
                ctx.rotate(angle + arc / 2 + Math.PI / 2);

                /** 下面代码根据奖品类型、奖品名称长度渲染不同效果，如字体、颜色、图片效果。(具体根据实际情况改变) **/
                if(text.indexOf("M")>0){//流量包
                    var texts = text.split("M");
                    for(var j = 0; j<texts.length; j++){
                        ctx.font = j == 0?'bold 20px Microsoft YaHei':'16px Microsoft YaHei';
                        if(j == 0){
                            ctx.fillText(texts[j]+"M", -ctx.measureText(texts[j]+"M").width / 2, j * line_height);
                        }else{
                            ctx.fillText(texts[j], -ctx.measureText(texts[j]).width / 2, j * line_height);
                        }
                    }
                }else if(text.indexOf("M") == -1 && text.length>6){//奖品名称长度超过一定范围
                    text = text.substring(0,10)+"||"+text.substring(10);
                    var texts = text.split("||");
                    for(var j = 0; j<texts.length; j++){
                        ctx.fillText(texts[j], -ctx.measureText(texts[j]).width / 2, j * line_height);
                    }
                }else{
                    //在画布上绘制填色的文本。文本的默认颜色是黑色
                    //measureText()方法返回包含一个对象，该对象包含以像素计的指定字体宽度
                    ctx.fillText(text, -ctx.measureText(text).width / 2, 0);
                }

                //添加对应图标
                if(text.indexOf("闪币")>0){
                    var img= document.getElementById("shan-img");
                    img.onload=function(){
                        ctx.drawImage(img,-15,10);
                    };
                    ctx.drawImage(img,-15,10);
                }else if(text.indexOf("谢谢参与")>=0){
                    var img= document.getElementById("sorry-img");
                    img.onload=function(){
                        ctx.drawImage(img,-15,10);
                    };
                    ctx.drawImage(img,-15,10);
                }
                //把当前画布返回（调整）到上一个save()状态之前
                ctx.restore();
                //----绘制奖品结束----
            }
        }
    }

</script>
<script type="text/javascript">
$(function(){
	$(".rotate-con-zhen").rotate({
		bind:{
			click:function(){
				var a = runzp();
				console.log(a);
				 $(this).rotate({
					 	duration:3000,
					 	angle: 0, 
            			animateTo:1440+120,
						easing: $.easing.easeOutSine,
						callback: function(){
							alert(a.prize+a.message);
						}
				 });
			}
		}
	});
});
</script>
</html>
