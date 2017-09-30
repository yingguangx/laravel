<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
        <link rel="shortcut icon" href="{{URL::asset('image/fish.jpg')}}">
        <title>消息/订单页</title>
		<link rel="stylesheet" type="text/css" href="{{ asset('css/messages/reset.css') }}"/>
		<link rel="stylesheet" type="text/css" href="{{ asset('css/messages/index.css') }}"/>
    </head>
	<body>
	<div style="display: none;" class="public_path"><?php echo public_path() ?></div>
		<!--头部-->
        <div style="width: 100%;margin-top: 15px;border-bottom: 1px solid gray;padding-bottom: 13px">
            <div style="float:left;width: 30%;margin-left: 17px">
                <span style="height: 10px;"><</span>
                <a href="javascript:window.history.go(-1)">
                    返回
                </a>
            </div>
            <div style="float:right;width: 57%;text-align: left;">
                <p>订单列表</p>
            </div>
            <div style="clear: both;"></div>
            <div style="width:60%;float: right;text-align: right;margin-top: 30px;margin-right:5px;">
                <a href="#" style="color:blue;">联系客服</a>&nbsp&nbsp<a style="color:blue;" onclick="reflesh() ">刷新试试</a>
            </div>
        </div>
	    <!--头部-->
	    <!--主题-->
	    <div class="no">
            <span style="margin-left: 15px;">暂无数据哦,去逛逛吧！</span>
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
                     <span style="margin-left: 15px;">暂无订单哦,去逛逛吧！</span>
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
                     <span style="margin-left: 15px;">暂无订单哦！</span>
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
