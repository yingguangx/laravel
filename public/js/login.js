/**
 * Created by Administrator on 2016/10/27 0027.
 */
function checkForm(){
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
    function checkCap(captcha,data){
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
                    return false;
                }else if(keys=="formPwd" && !data[keys].val().match(pwdReg)){
                    showTips.css("visibility","visible").removeClass("alert-warning").addClass("alert-danger").html("格式错误，密码为6-12位数字加字母");
                    return false;
                }else if(keys=="formEmail" && !data[keys].val().match(emailReg)){
                    showTips.css("visibility","visible").removeClass("alert-warning").addClass("alert-danger").html("格式错误，请检查邮箱格式");
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
    checkCap(captcha,data);
   // check(data);
}
function checkCustomerForm(){
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
                    showTips.css("visibility","visible").removeClass("alert-warning").addClass("alert-danger").html("验证码错误");
                        return false;    
                } else {
                    check(data);
                    checkExist(data["formName"].val(),data["formPwd"].val());
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
                    return false;
                }else if(keys=="formPwd" && !data[keys].val().match(pwdReg)){
                    showTips.css("visibility","visible").removeClass("alert-warning").addClass("alert-danger").html("格式错误，密码为6-12位数字加字母");
                    return false;
                }else if(keys=="formEmail" && !data[keys].val().match(emailReg)){
                    showTips.css("visibility","visible").removeClass("alert-warning").addClass("alert-danger").html("格式错误，请检查邮箱格式");
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
    }
    function checkExist(email,password){
         $.ajax({
            type: 'post',
            dataType: 'json',
            url: 'checkIfExist',
            data: {'username' : email, 'password':password},
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            success: function(result) {
                if (result.status == 'false') {
                $("#captcha_img").attr('src','../tool/captcha?r=' + Math.random() );
                    showTips.css("visibility","visible").removeClass("alert-warning").addClass("alert-danger").html("用户名或密码错误");
                        return false;    
                } else { 
                    $('#login_button').val('正在登陆中...');
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
