layui.use(['element','table', 'layer'], function () {
    var element = layui.element
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
            , { field: 'lk', title: '点赞数'}
            , { field: 'dt', title: '发布日期', align:'right', sort: true }
            , { align:'center', toolbar: '#operation-bar-draft', fixed: 'right'}
        ]]
    });
})