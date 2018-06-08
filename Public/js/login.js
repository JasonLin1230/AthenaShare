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
                    window.location='../Main/index.html';
                } else {
                    if(data.msg!=""){
                        layer.msg(data.msg, {
                            icon: 1
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
        if (data.field.password != data.field.password2) {
            layer.msg('两次密码输入不同！', {icon: 5});
            return false;
        }else{
            $.ajax({
                url: "reg",
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
                            window.location='../Login/index.html';
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
});