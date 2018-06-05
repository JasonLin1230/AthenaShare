layui.use(['element', 'form', 'table', 'layer'], function () {
    var element = layui.element
        , form = layui.form
        , table = layui.table
        , layer = layui.layer;
    element.on('tab(kng-tab)', function(data){
        switch(data.index)
        {
            case 0:
                table.reload('my_share', {
                    url: 'personal_kng_mine'
                });
                break;
            case 1:
                table.reload('draft', {
                    url: 'personal_kng_script'
                });
                break;
            default:
                element.init();
        }
    });
    table.render({
        elem: '#my_share'
        , id: 'my_share'
        , height: 320
        , url: 'personal_kng_mine' //数据接口
        , cellMinWidth: 60
        , page: true //开启分页
        , cols: [[ //表头
            { field: 'name', title: '标题'}
            , { field: 'ctnm', title: '类别'}
            , { field: 'dscr', title: '内容'}
            , { field: 'file_name', title: '文件'}
            , { field: 'lk', title: '点赞数'}
            , { field: 'dt', title: '发布日期', align:'right', sort: true }
            , { align:'center', toolbar: '#operation-bar-share', fixed: 'right'}
        ]]
    });
    table.render({
        elem: '#draft'
        , id: 'draft'
        , height: 320
        , url: 'personal_kng_script' //数据接口
        , cellMinWidth: 60
        , page: true //开启分页
        , cols: [[ //表头
            { field: 'name', title: '标题'}
            , { field: 'ctnm', title: '类别'}
            , { field: 'dscr', title: '内容'}
            , { field: 'file_name', title: '文件'}
            , { field: 'lk', title: '点赞数'}
            , { field: 'dt', title: '发布日期', align:'right', sort: true }
            , { align:'center', toolbar: '#operation-bar-draft', fixed: 'right'}
        ]]
    });
    table.on('tool', function(obj){
        var data = obj.data;
        if(obj.event === 'detail'){
            window.location='kng_detail'
        } else if(obj.event === 'delete'){
            layer.confirm('确认删除么', function(index){
                layer.close(index);
                return beauty_ajax("delete_kng",data,function () {
                    table.reload('my_share', {
                        url: "personal_kng_mine"
                    });
                    table.reload('draft', {
                        url: "personal_kng_script"
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
    form.on('submit(kng-release)', function (data) {//发布
        data.field['is_script']='0';
        data.field['kng_desc']=CKEDITOR.instances.textfield.getData();
        return beauty_ajax("insert_kng", data.field);
    });
    form.on('submit(kng-save)', function (data) {//保存
        data.field['is_script']='1';
        data.field['kng_desc']=CKEDITOR.instances.textfield.getData();
        return beauty_ajax("insert_kng", data.field);
    });
})