/**
 * Created by Administrator on 2016/10/27 0027.
 */
function checkReg(){    
    $("#check_button").attr('disabled','true'); 
    var data={
        "formName":$("#js_form_name"),
        "formPwd":$("#js_form_pwd"),
        "formEmail":$("#js_form_email"),
        "formNewPwd":$("#js_form_newpwd"),
        "formNewPwdRep":$("#js_form_newpwdrep")
    }
    var showTips=$(".alert");
    var targetPage=$("form").attr("action");
    var pwdReg="^[0-9A-Za-z]{6,12}$";
    var emailReg="^[A-Za-z0-9]+((-|_|\.)[A-Za-z0-9]+)*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$";
    var captcha = $("#js_form_captcha").val();
    var emailData = $("#js_form_email").val();
    var isReg = $("#js_form_Reg").val();
    function checkCap(captcha){
         $.ajax({
            type: 'post',
            dataType: 'json',
            url: '../tool/captchaJudge',
            data: {'cpt' : captcha},
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            success: function(result) {                
                if (result.status == 'false') {
                    $("#captcha_img").attr('src','../tool/captcha?r=' + Math.random() );
                    $("#check_button").removeAttr('disabled'); 
                    showTips.css("visibility","visible").removeClass("alert-warning").addClass("alert-danger").html("图片验证码错误");
                        return false;    
                } else {
                    check(data);
                    checkEmail(emailData,isReg);
                }
            },

            error: function(xhr, data) {

            }
        });
    }
    function check(data){
        for(var keys in data){
            if(data[keys][0] != undefined){
                if(data[keys].val() == null || data[keys].val()==""){
                    showTips.removeClass().addClass("col-xs-12 m-t-15 alert alert-warning");
                    showTips.css("visibility","visible");
                    showTips.html("请"+data[keys].attr("placeholder"));
                    data[keys].focus();
                    $("#check_button").removeAttr('disabled'); 
                    return false;
                }else if(keys=="formEmail" && !data[keys].val().match(emailReg)){
                    $("#check_button").removeAttr('disabled'); 
                    showTips.css("visibility","visible").removeClass("alert-warning").addClass("alert-danger").html("格式错误，请检查邮箱格式");
                    return false;
                }
            }
        }
        
    }
    function checkEmail(emailData,isReg){
         $.ajax({
            type: 'post',
            dataType: 'json',
            url: 'checkEmail',
            data: {'email' : emailData,'isReg':isReg},
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            success: function(result) {
                $("#captcha_img").attr('src','../tool/captcha?r=' + Math.random() );
                if (result.status == 'false') {
                    if(isReg=="1")
                    {
                        showTips.css("visibility","visible").removeClass("alert-warning").addClass("alert-danger").html("邮箱已被注册");
                    }
                    else{
                        showTips.css("visibility","visible").removeClass("alert-warning").addClass("alert-danger").html("该邮箱未注册");
                    }
                    $("#check_button").removeAttr('disabled'); 
                        return false;    
                } else {
                    $('#form').submit();
                }
            },

            error: function(xhr, data) {

            }
        });
    }
    checkCap(captcha);
   // check(data);
}
function checkRegDetail(){
    $("#check_button").attr('disabled','true'); 
    var data={
        "formName":$("#js_form_name"),
        "formPwd":$("#js_form_pwd"),
        "formEmail":$("#js_form_email"),
        "formCaptcha":$("#js_form_captcha"),
        "formNewPwd":$("#js_form_newpwd"),
        "formNewPwdRep":$("#js_form_newpwdrep"),
        "formFullname":$("#js_form_fullname")
    }
    var showTips=$(".alert");
    var targetPage=$("form").attr("action");
    var pwdReg="^[0-9A-Za-z]{6,12}$";
    var identify = $("#js_form_identify").val();
    function checkCap(captcha){
         $.ajax({
            type: 'post',
            dataType: 'json',
            url: 'checkIdentify',
            data: {'identify' : identify},
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            success: function(result) {                
                if (result.status == 'false') {
                    $("#captcha_img").attr('src','../tool/captcha?r=' + Math.random() );
                    $("#check_button").removeAttr('disabled'); 
                    showTips.css("visibility","visible").removeClass("alert-warning").addClass("alert-danger").html("验证码错误");
                        return false;    
                } else {
                    check(data);
                }
            },

            error: function(xhr, data) {

            }
        });
    }
    function check(data){
        for(var keys in data){
            if(data[keys][0] != undefined){
                if(data[keys].val() == null || data[keys].val()==""){
                    showTips.removeClass().addClass("col-xs-12 m-t-15 alert alert-warning");
                    showTips.css("visibility","visible");
                    showTips.html("请"+data[keys].attr("placeholder"));
                    data[keys].focus();
                    $("#check_button").removeAttr('disabled'); 
                    return false;
                }else if(keys=="formNewPwd" && !data[keys].val().match(pwdReg)){
                    showTips.css("visibility","visible").removeClass("alert-warning").addClass("alert-danger").html("格式错误，密码为6-12位数字加字母");
                    $("#check_button").removeAttr('disabled'); 
                    return false;
                }else if(keys=="formNewPwdRep" && !data[keys].val().match(pwdReg)){
                    showTips.css("visibility","visible").removeClass("alert-warning").addClass("alert-danger").html("格式错误，密码为6-12位数字加字母");
                    $("#check_button").removeAttr('disabled'); 
                    return false;
                }else if(data["formNewPwd"].val()!=data["formNewPwdRep"].val()){
                    showTips.css("visibility","visible").removeClass("alert-warning").addClass("alert-danger").html("两次输入密码不一致");
                    $("#check_button").removeAttr('disabled'); 
                    return false;
                }
            }
        }
        $('#form').submit();
    }
    checkCap(data);    
}
function checkPassword(){
    var data={
        "formNewPwd":$("#js_form_newpwd"),
        "formNewPwdRep":$("#js_form_newpwdrep")
    }
    var showTips=$(".alert");
    var targetPage=$("form").attr("action");
    var pwdReg="^[0-9A-Za-z]{6,12}$";
    function check(data){
        for(var keys in data){
            if(data[keys][0] != undefined){
                if(data[keys].val() == null || data[keys].val()==""){
                    showTips.removeClass().addClass("col-xs-12 m-t-15 alert alert-warning");
                    showTips.css("visibility","visible");
                    showTips.html("请"+data[keys].attr("placeholder"));
                    data[keys].focus();
                    return false;
                }else if(keys=="formNewPwd" && !data[keys].val().match(pwdReg)){
                    showTips.css("visibility","visible").removeClass("alert-warning").addClass("alert-danger").html("格式错误，密码为6-12位数字加字母");
                    return false;
                }else if(keys=="formNewPwdRep" && !data[keys].val().match(pwdReg)){
                    showTips.css("visibility","visible").removeClass("alert-warning").addClass("alert-danger").html("格式错误，密码为6-12位数字加字母");
                    return false;
                }else if(data["formNewPwd"].val()!=data["formNewPwdRep"].val()){
                    showTips.css("visibility","visible").removeClass("alert-warning").addClass("alert-danger").html("两次输入密码不一致");
                    return false;
                }
            }
        }
        $('#form').submit();
    }
    check(data);    
}