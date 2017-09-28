<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
		<title>消息/订单页</title>
		<link rel="stylesheet" type="text/css" href="{{ asset('css/messages/reset.css') }}"/>
		<link rel="stylesheet" type="text/css" href="{{ asset('css/messages/index.css') }}"/>
	</head>
	<body>
	<div style="display: none;" class="public_path"><?php echo public_path() ?></div>
		<!--头部-->
	    <header>
	    	交易有问题？<span class="fr"><a href="#" style="color:blue;">联系客服</a>&nbsp&nbsp<a style="color:blue;" onclick="reflesh() ">刷新试试</a>&nbsp&nbsp<a style="color:blue;"  href="/user">个人中心</a></span>
	    </header>
	    <!--头部-->
	    <!--主题-->
	    <div class="no">
	    	<p>暂无数据，快去逛逛吧！</p>
	    </div>
	    <div class="con">	
	    <div class="content">
	    	<div class="list">
	    		<div class="fl">
	    			<label>
		    			<input type="checkbox" checked="checked"/>
		    			<img src="{{URL::asset('image/messages_pic/c_checkbox_on.png')}}"/>
		    		</label>
	    		</div>
	    		<p>正在处理</p>
	    	</div>
		    <ul ind="0">
		    <?php 
		    	if ($messages_unfinish != array() ) {
		    	foreach ($messages_unfinish as $key => $message) {
		    	if ($message['type'] == 1) {
		    ?>
		    	<li class="clearfix">
		    		<div class="label fl">
		    			<label>
			    			<input type="checkbox" checked="checked"/>
			    			<img src="{{URL::asset('image/messages_pic/c_checkbox_on.png')}}"/>
			    		</label>
		    		</div>
		    		<div class="img fl">
		    			<img src="{{URL::asset('image/messages_pic/logo.png')}}"/>
		    		</div>
		    		<div class="text fl">
		    			<p class="overflow"><?php echo $message['content'] ?></p>
		    			<p class="clearfix">
		    				<span class="fl red">￥<?php echo $message['money'] ?></span>
		    				<span class="fr">
		    					<?php echo $message['order_time'] ?>
		    				</span>
		    			</p>
		    		</div>
		    	</li>
		    <?php } if ($message['type'] == 2) {
		     ?>
		     <li class="clearfix">
		    		<div class="label fl">
		    			<label>
			    			<input type="checkbox" checked="checked"/>
			    			<img src="{{URL::asset('image/messages_pic/c_checkbox_on.png')}}"/>
			    		</label>
		    		</div>
		    		<div class="img fl">
		    			<img src="{{URL::asset('image/messages_pic/logo.png')}}"/>
		    		</div>
		    		<div class="text fl">
		    			<p class="overflow"><?php echo $message['content'] ?></p>
		    			<p class="clearfix">
		    				<span class="fl red"><?php echo $message['money'] ?></span>
		    				<span class="fr">
		    					<?php echo $message['order_time'] ?>
		    				</span>
		    			</p>
		    		</div>
		    	</li>
		    	<?php }}}else{ ?>
		    	 <li class="clearfix">
		    			<label>
			    			没有订单哦！
			    		</label>
		    	</li>
		    	<?php } ?>

		    </ul>
	    </div>
	    <div class="content">
	    	<div class="list">
	    		<div class="fl">
	    			<label>
		    			<input type="checkbox" checked="checked"/>
		    			<img src="{{URL::asset('image/messages_pic/c_checkbox_on.png')}}"/>
		    		</label>
	    		</div>
	    		<p>今日已完成</p>
	    	</div>
		    <ul  ind="1">
		       <?php 
		       if ($messages != array() ) {
		       foreach ($messages as $key => $message) {
		    	if ($message->type == 1) {
		    ?>
		    	<li class="clearfix">
		    		<div class="label fl">
		    			<label>
			    			<input type="checkbox" checked="checked"/>
			    			<img src="{{URL::asset('image/messages_pic/c_checkbox_on.png')}}"/>
			    		</label>
		    		</div>
		    		<div class="img fl">
		    			<img src="{{URL::asset('image/messages_pic/logo.png')}}"/>
		    		</div>
		    		<div class="text fl">
		    			<p class="overflow"><?php echo $message->content ?></p>
		    			<p class="clearfix">
		    				<span class="fl red">￥<?php echo $message->money ?></span>
		    				<span class="fr">
		    					<?php echo $message->order_time ?>
		    				</span>
		    			</p>
		    		</div>
		    	</li>
		    <?php } if ($message->type == 2) {
		     ?>
		     <li class="clearfix">
		    		<div class="label fl">
		    			<label>
			    			<input type="checkbox" checked="checked"/>
			    			<img src="{{URL::asset('image/messages_pic/c_checkbox_on.png')}}"/>
			    		</label>
		    		</div>
		    		<div class="img fl">
		    			<img src="{{URL::asset('image/messages_pic/logo.png')}}"/>
		    		</div>
		    		<div class="text fl">
		    			<p class="overflow"><?php echo $message->content ?></p>
		    			<p class="clearfix">
		    				<span class="fl red"><?php echo $message->money ?></span>
		    				<span class="fr">
		    					<?php echo $message->order_time ?>
		    				</span>
		    			</p>
		    		</div>
		    	</li>
		    	<?php }}}else{ ?>
		    	 <li class="clearfix">
		    			<label>
			    			没有订单哦！
			    		</label>
		    	</li>
		    	<?php } ?>
		   
		    </ul>
	    </div>
	    </div>
	    <!--主题-->
	    <!--结算-->
	    <div class="bottom fixed">
	    	<div class="fl bottom-label">
	    		<label>
	    			<input type="checkbox" checked="checked"/>
	    			<img src="{{URL::asset('image/messages_pic/c_checkbox_on.png')}}" class="fl" />
	    			全选
	    		</label>
	    	</div>
    		<div class="fr">
    			页面交易消息只显示当天
    			<button class="sett">删除</button>
    		</div>
	    </div>
	     <!--结算-->
	     <!--删除-->
	    <div class="bottom fixed" style="display: none;">
    		<div class="fr">
    			<button class="delete">删除</button>
    		</div>
	    </div>
	     <!--删除-->
	     <!--弹框-->
	    <div class="text1 fixed">
	    	<form>
	    		<input type="number"/>
	    		<input type="button"  value="确定"/>
	    	</form>
	    </div>
	     <!--弹框-->
	    <!--弹框2-->
	    <div class="alert fixed"></div>
	     <!--弹框2-->
		<script src="{{URL::asset('js/messages/web.js')}}"></script>
		<script src="{{URL::asset('js/messages/zepto.js')}}"></script>
		<script src="{{URL::asset('js/messages/index.js')}}"></script>
	</body>
</html>
<script>
	function reflesh()
	{
		location.reload(); 
	}
</script>
