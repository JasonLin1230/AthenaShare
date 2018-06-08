layui.use(['element',  'layer', 'form', 'jquery','laypage', 'table'], function () {
    var element = layui.element
        , layer = layui.layer
        , form = layui.form
        , laypage = layui.laypage
        , table = layui.table
        , $ = layui.$
        , new_admin_layer;
    table.init('center');
    $(".new-admin-btn").click(function () {
        new_admin_layer = layer.open({
            type: 1,
            title: '新增管理员',
            content: $('#new-admin').html()
        });
    });
    form.on('submit(new-admin)', function (data) {
        return beauty_ajax("add_admin", data.field, function(){
            layer.close(new_admin_layer);
            setTimeout(function () {
                location.reload();
            },1000);
        });
    });
});