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
    table.render({//用户管理表
        elem: '#admin-usr'
        , id: 'admin-usr'
        , height: 400
        , url: 'usr' //数据接口
        , cellMinWidth: 60
        , page: true //开启分页
        , cols: [[ //表头
            { field: 'name', title: '用户名'}
            , { field: 'real_name', title: '昵称'}
            , { field: 'email', title: '邮箱'}
            , { field: 'phone', title: '手机号'}
            , { field: 'personal_kng_count', title: '分享知识数'}
            , { align:'center', toolbar: '#operation-bar-del', fixed: 'right'}
        ]]
    });
    table.on('tool', function(obj){
        var data = obj.data;
        if(obj.event === 'delete'){
            layer.confirm('谨慎操作，删除后无法恢复！', function(index){
                layer.close(index);
                return beauty_ajax("del_usr",data,function () {
                    table.reload('admin-usr', {
                        url: "usr"
                    });
                });
            });
        } else if(obj.event === 'release'){
            layer.confirm('确认发布么', function(index){
                layer.close(index);
                return beauty_ajax("push_draft",data,function () {
                    table.reload('draft', {
                        url: "personal_kng_script"
                    });
                });
            });
        }
    });
});