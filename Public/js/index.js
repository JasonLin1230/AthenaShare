layui.use(['element', 'form','table','upload', 'layer', 'jquery'], function () {
    var element = layui.element
        , form = layui.form
        , table = layui.table
        , upload = layui.upload
        , layer = layui.layer
        , $ = layui.$;
    $("#password-btn").click(function () {    //修改密码按钮
        layer.open({
            type: 1,
            title: '修改密码',
            content: $('#passwordTp').html()
        });
    });
    table.render({
        elem: '#latest_share'
        , id: 'latest_share'
        , height: 320
        , url: 'get_latest' //数据接口
        , cellMinWidth: 60
        , cols: [[ //表头
            { field: 'name', title: '标题'}
            , { field: 'acc', title: '作者'}
            , { field: 'ctnm', title: '类别'}
            , { field: 'dscr', title: '内容'}
            , { field: 'lk', title: '点赞数'}
            , { field: 'dt', title: '发布日期', align:'right', sort: true }
            , { align:'center', title: '操作', toolbar: '#operation-bar-share', fixed: 'right'}
        ]]
    });
    table.render({
        elem: '#sent_msg'
        , id: 'sent_msg'
        , height: 320
        , url: 'person_msg_send' //数据接口
        , cellMinWidth: 60
        , page: true //开启分页
        , cols: [[ //表头
            { field: 'dscrib', title: '简讯'}
            , { field: 'account', title: '接收者'}
            , { field: 'date', title: '时间', align:'right', sort: true }
            , { align:'center', toolbar: '#operation-bar-msg', fixed: 'right'}
        ]]
    });
    table.render({
        elem: '#read_msg'
        , id: 'read_msg'
        , height: 320
        , url: 'person_msg_recive' //数据接口
        , cellMinWidth: 60
        , page: true //开启分页
        , cols: [[ //表头
            { field: 'dscrib', title: '简讯'}
            , { field: 'account', title: '发送者'}
            , { field: 'date', title: '时间', align:'right', sort: true }
            , { align:'center', toolbar: '#operation-bar-msg', fixed: 'right'}
        ]]
    });
    table.render({
        elem: '#unread_msg'
        , id: 'unread_msg'
        , height: 320
        , url: 'person_msg_new' //数据接口
        , cellMinWidth: 60
        , page: true //开启分页
        , cols: [[ //表头
            { field: 'dscrib', title: '简讯'}
            , { field: 'account', title: '发送者'}
            , { field: 'date', title: '时间', align:'right', sort: true }
            , { align:'center', toolbar: '#operation-bar-msg', fixed: 'right'}
        ]]
    });
    table.render({
        elem: '#private_src'
        , id: 'private_src'
        , height: 320
        , url: 'personal_src_private' //数据接口
        , cellMinWidth: 60
        , page: true //开启分页
        , cols: [[ //表头
            { field: 'name', title: '标题'}
            , { field: 'dscrib', title: '内容'}
            , { field: 'times', title: '下载量'}
            , { field: 'date', title: '时间', align:'right', sort: true }
            , { align:'center', toolbar: '#operation-bar-src', fixed: 'right'}
        ]]
    });
    table.render({
        elem: '#share_src'
        , id: 'share_src'
        , height: 320
        , url: 'personal_src_share' //数据接口
        , cellMinWidth: 60
        , page: true //开启分页
        , cols: [[ //表头
            { field: 'name', title: '标题'}
            , { field: 'dscrib', title: '内容'}
            , { field: 'times', title: '下载量'}
            , { field: 'date', title: '时间', align:'right', sort: true }
            , { align:'center', toolbar: '#operation-bar-src', fixed: 'right'}
        ]]
    });
    var uploadSrc = upload.render({
        elem: '#upsrc' //绑定元素
        ,url: '/upload/' //上传接口
        ,done: function(res){
            //上传完毕回调
        }
        ,error: function(){
            //请求异常回调
        }
    });
});
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