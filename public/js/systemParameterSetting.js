$('#menu_sys').on('click',function (e) {
	var v = $(e.target).html();
	$("#tip").html("");
	if(v=="国家设置"){
		$('#ct>form').addClass('dispaly-none');
		$('.sys_1').removeClass('dispaly-none');
	}else if(v=="北极星重量档"){
		$('#ct>form').addClass('dispaly-none');
		$('.sys_2').removeClass('dispaly-none');
	}else if(v=="客户组设置"){
		$('#ct>form').addClass('dispaly-none');
		$('.sys_3').removeClass('dispaly-none');
	}else if(v=="收款信息设置"){
		$('#ct>form').addClass('dispaly-none');
		$('.sys_4').removeClass('dispaly-none');
	}else if(v=="余额调整原因"){
		$('#ct>form').addClass('dispaly-none');
		$('.sys_5').removeClass('dispaly-none');
	}else if(v=="重量档设置"){
		$('#ct>form').addClass('dispaly-none');
		$('.sys_6').removeClass('dispaly-none');
	}else if(v=="售后类型"){
		$('#ct>form').addClass('dispaly-none');
		$('.sys_7').removeClass('dispaly-none');
	}else if(v=="系统参数设置"){
		$('#ct>form').addClass('dispaly-none');
		$('.sys_8').removeClass('dispaly-none');
	}
});
