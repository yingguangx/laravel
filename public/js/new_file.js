
$(function(){
    $(".cal").click(function(e){
        $(".f-overlay").hide();
        $(".addvideo").hide();
    })
    $(".person_wallet_recharge .ul li").click(function(e){
        $(this).addClass("current").siblings("li").removeClass("current");
        $(this).children(".sel").show(0).parent().siblings().children(".sel").hide(0);
    });
})
function check_money(){
    var a=100;

        var txt = $("#txt").val();
        if(!$(".person_wallet_recharge .ul li").hasClass('current') && txt ==''){
            layer.open({
                content: '请输入或选择金额',
                style: 'background:rgba(0,0,0,0.6); color:#fff; border:none;',
                time:3000
            });
            return false;
        }
        if(!$(".person_wallet_recharge .ul li").hasClass('current')){
            if( txt < a){
                layer.open({
                    content: '金额必须是100元以上',
                    style: 'background:rgba(0,0,0,0.6); color:#fff; border:none;',
                    time:3000
                });
                return false;
            }
        }
        return true;
}


