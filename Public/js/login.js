layui.use(['element', 'form', 'layer', 'jquery'], function () {
    var element = layui.element
        , form = layui.form
        , layer = layui.layer
        , $ = layui.$
        , forget_pass_layer;
    form.on('submit(user-login-submit)', function (data) {
        $.ajax({
            url: "checklog",
            type: "post",
            data: data.field,
            success: function (data) {
                data = JSON.parse(data);
                if (data.code === 0) {
                    window.location='../Main/main.html';
                } else {
                    if(data.msg!=""){
                        layer.msg(data.msg, {
                            icon: 2
                            , shade: 0.1
                            , time: 2000
                        });
                    }else{
                        layer.msg('未知错误', {
                            icon: 2
                            , shade: 0.1
                            , time: 2000
                        });
                    }
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                layer.msg(XMLHttpRequest.status + '登录失败', {
                    icon: 2
                    , shade: 0.1
                    , time: 2000
                })
            },
            complete: function (XMLHttpRequest, textStatus) {
                this;
            }
        });
        return false;
    });
    $("#forgetpass-btn").click(function () {
        forget_pass_layer = layer.open({
            type: 1,
            title: '重置密码',
            content: $('#forgetpass').html()
        });
    });
    form.on('submit(forgetpass)', function (data) {
        return beauty_ajax("send_email", data.field, function(){
            layer.close(forget_pass_layer);
        });
    });
    form.on('submit(user-reg-submit)', function (data) {
        if(data.field.password.length <6){
            layer.msg('密码至少为6位！', {icon: 5});
            return false;
        }else if (data.field.password != data.field.password2) {
            layer.msg('两次密码输入不同！', {icon: 5});
            return false;
        }else{
            $.ajax({
                url: "reg_usr",
                type: "post",
                data: data.field,
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.code === 0) {
                        layer.msg('注册成功', {
                            icon: 1
                            , shade: 0.1
                            , time: 2000
                        },function () {
                            window.location='../Login/login.html';
                        });
                    } else {
                        if(data.msg!=""){
                            layer.msg(data.msg, {
                                icon: 2
                                , shade: 0.1
                                , time: 2000
                            });
                        }else{
                            layer.msg('未知错误', {
                                icon: 2
                                , shade: 0.1
                                , time: 2000
                            });
                        }
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    layer.msg(XMLHttpRequest.status + '注册失败', {
                        icon: 2
                        , shade: 0.1
                        , time: 2000
                    })
                },
                complete: function (XMLHttpRequest, textStatus) {
                    this;
                }
            });
            return false;
        }
    });
    var countdown=60;
    function settime(obj) {//设置按钮提示
        obj.unbind();
        // 邮箱正则
        var reg = new RegExp("^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$");
        var email_val=$("#user-login-email").val();
        if(!reg.test(email_val)){
            layer.msg('邮箱格式不正确', {
                icon: 2
                , shade: 0.1
                , time: 1000
            });
            $("#LAY-user-getsmscode").on('click',function () {
                settime($(this));
                send_valid_email();
            })
            return false;
        }
        if (countdown == 0) {
            obj.removeClass("layui-disabled");
            obj.text("获取验证码");
            countdown = 60;
            $("#LAY-user-getsmscode").on('click',function () {
                settime($(this));
                send_valid_email();
            })
            return;
        } else {
            obj.addClass("layui-disabled");
            obj.text(countdown + "秒后重获");
            countdown--;
        }
        setTimeout(function() {
            settime(obj)
        },1000)
    }
    function send_valid_email(){
        var email_val=$("#user-login-email").val();
        $.ajax({
            url: "reg_usr",
            type: "post",
            data: {
                email:email_val
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.code === 0) {
                    layer.msg('发送成功，注意查收', {
                        icon: 1
                        , shade: 0.1
                        , time: 2000
                    },function () {
                        $("#LAY-user-submit").removeClass('layui-btn-disabled');
                    });
                } else {
                    if(data.msg!=""){
                        layer.msg(data.msg, {
                            icon: 2
                            , shade: 0.1
                            , time: 2000
                        });
                    }else{
                        layer.msg('未知错误', {
                            icon: 2
                            , shade: 0.1
                            , time: 2000
                        });
                    }
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                layer.msg(XMLHttpRequest.status + '验证邮箱失败', {
                    icon: 2
                    , shade: 0.1
                    , time: 2000
                })
            },
            complete: function (XMLHttpRequest, textStatus) {
                this;
            }
        });
    }
    $("#LAY-user-getsmscode").on('click',function () {
        return settime($(this));
        send_valid_email();
    });
});