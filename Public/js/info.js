layui.use(['form', 'jquery', 'layer'], function () {
    var form = layui.form,
        layer = layui.layer,
        $ = layui.$;
    $.ajax({
        url: 'get_info',
        type: "get",
        success: function (data) {
            myInfo = JSON.parse(data);
            form.val("info", {
                "name": myInfo.name
                ,"account": myInfo.account
                ,"office": myInfo.office
                ,"gender": myInfo.gender
                ,"email": myInfo.email
                ,"phone": myInfo.phone
            })
            form.render(null, 'info');
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            layer.msg(XMLHttpRequest.status + '信息获取失败', {
                icon: 2
                , shade: 0.1
                , time: 2000
            })
        },
        complete: function (XMLHttpRequest, textStatus) {
            this;
        }
    });
    form.on('submit(info-btn)', function (data) {//修改
        return beauty_ajax("edit_info", data.field, function () {
            location.reload();
        });
    });
});