layui.use(['element', 'form', 'layer', 'jquery'], function () {
    var element = layui.element
        , form = layui.form
        , layer = layui.layer
        , $ = layui.$
        , pass_layer;
    $("#password-btn").click(function () {    //修改密码按钮
        pass_layer = layer.open({
            type: 1,
            title: '修改密码',
            content: $('#passwordTp').html()
        });
    });
    form.on('submit(password)', function (data) {
        if (data.field.new_pass != data.field.confirm_pass) {
            layer.msg('两次密码输入不同！', {icon: 5});
            return false;
        }else if(data.field.old_pass == data.field.new_pass){
            layer.msg('新密码与原密码相同！', {icon: 5});
            return false;
        }else{
            return beauty_ajax("../Base/ex_pass", data.field, function(){
                layer.close(pass_layer);
                setTimeout(function () {
                    window.location.href="Login/index";
                },1500);
            });
        }
    });
});
(function() {
    var OriginTitile = document.title, titleTime;
    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            document.title = '死鬼去哪里了！';
            clearTimeout(titleTime);
        } else {
            document.title = '(つェ⊂)咦!又好了!';
            titleTime = setTimeout(function() {
                document.title = OriginTitile;
            },2000);
        }
    });
})();
function beauty_ajax(url,data,success_func) {//ajax表单提交
    var $ = layui.$
        , layer = layui.layer;
    var submitting = layer.msg('正在提交', {
        icon: 16
        , shade: 0.1
        , time: 0
    });
    console.log(data);          //打印即将发送的数据
    $.ajax({
        url: url,
        type: "post",
        data: data,
        success: function (data) {
            console.log(data);  //打印接受到的数据
            data = JSON.parse(data);
            if (data.code === 0 || data.status === 1) {
                layer.close(submitting);
                layer.msg('提交成功', {
                    icon: 1
                    , shade: 0.1
                    , time: 1000
                })
                if(success_func !== undefined){
                    success_func();
                }
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
            layer.msg(XMLHttpRequest.status + '提交失败', {
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
};