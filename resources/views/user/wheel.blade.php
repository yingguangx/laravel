<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>红色大气转盘抽奖活动专题模板</title>
<link href="{{URL::asset('css/zp_style.css')}}" rel="stylesheet" />
<link href="{{URL::asset('css/style.css')}}" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{{URL::asset('js/jquery-1.8.0.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/jQueryRotate.2.2.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/awardRotate.js')}}"></script>
{{--<script type="text/javascript" src="{{URL::asset('js/jquery.easing.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{URL::asset('js/zp.js')}}"></script>--}}

<script type="text/javascript">
$(function(){
	//多行应用@Mr.Think
	var _wrap=$('ul.mulitline');//定义滚动区域
	var _interval=3000;//定义滚动间隙时间
	var _moving;//需要清除的动画
	_wrap.hover(function(){
		clearInterval(_moving);//当鼠标在滚动区域中时,停止滚动
	},function(){
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
    <div style="display:none">
      <script type="text/javascript">
          var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
          document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F6f798e51a1cd93937ee8293eece39b1a' type='text/javascript'%3E%3C/script%3E"));
      </script>
      <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_5718743'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s9.cnzz.com/stat.php%3Fid%3D5718743%26show%3Dpic2' type='text/javascript'%3E%3C/script%3E"));</script>
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
                <li><span class="txt">永久性<font>高级会员</font></span><strong class="num">182****9659</strong></li>
                <li><span class="txt">永久性<font>VIP6会员</font></span><strong class="num">182****9659</strong></li>
                <li><span class="txt"><font>80元</font>运费抵扣券</span><strong class="num">182****9659</strong></li>
                <li><span class="txt">永久性<font>高级会员</font></span><strong class="num">182****9659</strong></li>
                <li><span class="txt">永久性<font>高级会员</font></span><strong class="num">182****9659</strong></li>
                <li><span class="txt">永久性<font>高级会员</font></span><strong class="num">182****9659</strong></li>
                <li><span class="txt"><font>40元</font>运费抵扣券</span><strong class="num">182****9659</strong></li>
                <li><span class="txt">永久性<font>高级会员</font></span><strong class="num">182****9659</strong></li>
                <li><span class="txt">永久性<font>VIP6会员</font></span><strong class="num">182****9659</strong></li>
                <li><span class="txt"><font>80元</font>运费抵扣券</span><strong class="num">182****9659</strong></li>
                <li><span class="txt">永久性<font>高级会员</font></span><strong class="num">182****9659</strong></li>
                <li><span class="txt">永久性<font>高级会员</font></span><strong class="num">182****9659</strong></li>
                <li><span class="txt">永久性<font>高级会员</font></span><strong class="num">182****9659</strong></li>
                <li><span class="txt"><font>40元</font>运费抵扣券</span><strong class="num">182****9659</strong></li>
                <li><span class="txt">永久性<font>高级会员</font></span><strong class="num">182****9659</strong></li>
                <li><span class="txt">永久性<font>高级会员</font></span><strong class="num">182****9659</strong></li>
                <li><span class="txt">永久性<font>高级会员</font></span><strong class="num">182****9659</strong></li>
                <li><span class="txt"><font>10元</font>运费抵扣券</span><strong class="num">182****9659</strong></li>
                <li><span class="txt">永久性<font>高级会员</font></span><strong class="num">182****9659</strong></li>
                <li><span class="txt">永久性<font>高级会员</font></span><strong class="num">182****9659</strong></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- 中奖列表end --> 
  </div>
  <div class="Rule">
    <h2><img src="images/Activities_08.jpg" width="108" height="35" alt=""/></h2>
    <ul>
      <li>
        <p>1. 注册或登录；</p>
      </li>
      <li>
        <p><span style=" float:left;display:inline-block">2. 点击</span>
        <div class="pop_right_qq1"><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=87423050&amp;site=qq&amp;menu=yes" style="padding-right:0;background:transparent"><img border="0" src="http://wpa.qq.com/pa?p=2:87423050:51" alt="点击这里给我发消息" title="点击这里给我发消息"></a></div>
        <span style=" float:left;display:inline-block; color:#FFF;">进入活动页面，参与抽奖，抽奖结果将在活动当前<br />
页面立即显示；</span>
        </p>
      </li>
      <li>
        <p>3. 点击向客服人员提供您会员名（<a href="#">立即注册</a>）；</p>
      </li>
      <li>
        <p>4. XXX会在第一时间将中奖礼品发送至您的账户；</p>
      </li>
      <li>
        <p>5. 所有中奖结果将于活动结束后5个工作日内在XXX网站首页进行公示；</p>
      </li>
    </ul>
  </div>
</div>
<div class="letter_mian4">
  <div class="invite_title">
    <h3 class="invite_title_l"></h3>
    <span class="fh_top"> <a href="#top" target="_self" title="返回顶部"><img src="images/ic_top.png" /></a></span></div>
  <div class="rules_presented_box" style="border-left:none;height:auto;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="invite_table">
      <tr>
        <th width="25%" scope="col" align="center">奖品设置</th>
        <th width="25%" scope="col" align="center">奖品</th>
        <th width="25%" scope="col" align="center">奖品份额</th>
        <th width="25%" scope="col" align="center">详情</th>
      </tr>
      <tr>
        <td align="center">特等奖</td>
        <td align="center">永久性高级会员</td>
        <td align="center">1</td>
        <td align="center"><p style="padding:7px 0;">终身享受转运85折<br/>
            运费优惠及各种增值服务</p></td>
      </tr>
      <tr>
        <td align="center">一等奖</td>
        <td align="center">永久性VIP6会员</td>
        <td align="center">5</td>
        <td align="center"><p style="padding:7px 0;">终身享受93折<br/>
            运费优惠 </td>
      </tr>
        </tr>
      
      <tr>
        <td align="center">二等奖</td>
        <td align="center">80元运费抵扣券</td>
        <td align="center">10</td>
        <td align="center"><p style="padding:7px 0;">分四张，可直接抵扣<br/>
            转运运费 </td>
      </tr>
      <tr>
        <td align="center">三等奖</td>
        <td align="center">40元运费抵扣券</td>
        <td align="center">20</td>
        <td align="center"><p style="padding:7px 0;">分两张，可分两次直接抵扣<br/>
            运费 </td>
      </tr>
      <tr>
        <td align="center">幸运奖</td>
        <td align="center">10元运费抵扣券</td>
        <td align="center">50</td>
        <td align="center"><p style="padding:7px 0;">可直接抵扣运费</td>
      </tr>
      <tr>
        <td align="center">阳光普照奖</td>
        <td align="center">5元运费抵扣券</td>
        <td align="center">不限额</td>
        <td align="center"><p style="padding:7px 0;">可直接抵扣运费</td>
      </tr>
    </table>
  </div>
  <div class="clear"></div>
</div>
<div class="Activities">
  <h1><span class="fh_top2"> <a href="#top" target="_self" title="返回顶部"><img src="images/ic_top.png" /></a></span><img src="images/Activities_09.jpg" width="146" height="35" alt=""/></h1>
  <div class="ate_box">
    <p>1. 该活动仅限被审核通过的会员参加（<a href="#">立即注册</a>）；</p>
    <p>2. 每位会员有且仅有一次抽奖资格；</p>
    <p>3. 对未按照活动规则参与抽奖，或不符合抽奖资格的会员，活动主办方有权取消其抽奖资格，并收回其抽奖所获得奖品；</p>
    <p>4. 会员参加活动的否成功，以活动页面提示为准，如因网络系统异常问题，导致无法参与抽奖，将不给予补偿；</p>
    <p>5. 本活动由XXX独家承办，XXX联合赞助；</p>
    <p>6. XXX拥有此次活动的最终解释权。更多模板：<a href="http://www.mycodes.net/" target="_blank">源码之家</a></p>
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
        //动态添加大转盘的奖品与奖品区域背景颜色
        // turnplate.restaraunts = ["50M免费流量包", "10闪币", "谢谢参与", "5闪币", "10M免费流量包", "20M免费流量包", "20闪币 ", "30M免费流量包", "100M免费流量包", "2闪币"];
        // turnplate.colors = ["#FFF4D6", "#FFFFFF", "#FFF4D6", "#FFFFFF","#FFF4D6", "#FFFFFF", "#FFF4D6", "#FFFFFF","#FFF4D6", "#FFFFFF"];
        turnplate.restaraunts = ["50M免费流量包", "10闪币", "谢谢参与", "5闪币", "10M免费流量包"];
        turnplate.colors = ["#FFF4D6", "#FFFFFF", "#FFF4D6", "#FFFFFF","#FFF4D6"];

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
                duration:8000,
                callback:function (){
                    alert(txt);
                    turnplate.bRotate = !turnplate.bRotate;
                }
            });
        };

        $('.pointer').click(function (){
            if(turnplate.bRotate)return;
            turnplate.bRotate = !turnplate.bRotate;
            //获取随机数(奖品个数范围内)
            var item = rnd(1,turnplate.restaraunts.length);
            //奖品数量等于10,指针落在对应奖品区域的中心角度[252, 216, 180, 144, 108, 72, 36, 360, 324, 288]
            rotateFn(item, turnplate.restaraunts[item-1]);
          /* switch (item) {
           case 1:
           rotateFn(252, turnplate.restaraunts[0]);
           break;
           case 2:
           rotateFn(216, turnplate.restaraunts[1]);
           break;
           case 3:
           rotateFn(180, turnplate.restaraunts[2]);
           break;
           case 4:
           rotateFn(144, turnplate.restaraunts[3]);
           break;
           case 5:
           rotateFn(108, turnplate.restaraunts[4]);
           break;
           case 6:
           rotateFn(72, turnplate.restaraunts[5]);
           break;
           case 7:
           rotateFn(36, turnplate.restaraunts[6]);
           break;
           case 8:
           rotateFn(360, turnplate.restaraunts[7]);
           break;
           case 9:
           rotateFn(324, turnplate.restaraunts[8]);
           break;
           case 10:
           rotateFn(288, turnplate.restaraunts[9]);
           break;
           } */
            console.log(item);
        });
    });

    function rnd(n, m){
        var random = Math.floor(Math.random()*(m-n+1)+n);
        return random;

    }


    //页面所有元素加载完毕后执行drawRouletteWheel()方法对转盘进行渲染
    window.onload=function(){
        drawRouletteWheel();
    };

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
                    text = text.substring(0,6)+"||"+text.substring(6);
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
