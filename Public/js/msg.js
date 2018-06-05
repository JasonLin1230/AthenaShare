layui.use(['element', 'form', 'table', 'layer'], function () {
    var element = layui.element
        , form = layui.form
        , table = layui.table
        , layer = layui.layer;
    element.on('tab(msg-tab)', function(data){
        switch(data.index)
        {
            case 0:
                table.reload('sent_msg', {
                    url: 'person_msg_send'
                });
                break;
            case 1:
                table.reload('read_msg', {
                    url: 'person_msg_recive'
                });
                break;
            case 2:
                table.reload('unread_msg', {
                    url: 'person_msg_new'
                });
                break;
            default:
                element.init();
        }
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
            , { align:'center', toolbar: '#operation-bar-unmsg', fixed: 'right'}
        ]]
    });
    table.on('tool', function(obj){
        var data = obj.data;
        if(obj.event === 'delete'){
            layer.confirm('确认删除么', function(index){
                layer.close(index);
                return beauty_ajax("delete_msg",data,function () {
                    table.reload('sent_msg', {
                        url: "person_msg_send"
                    });
                    table.reload('read_msg', {
                        url: "person_msg_recive"
                    });
                    table.reload('unread_msg', {
                        url: "person_msg_new"
                    });
                });
            });
        }else if(obj.event === 'read'){
            layer.confirm('确认已读么', function(index){
                layer.close(index);
                return beauty_ajax("person_msg_read",data,function () {
                    table.reload('read_msg', {
                        url: "person_msg_recive"
                    });
                    table.reload('unread_msg', {
                        url: "person_msg_new"
                    });
                });
            });
        }
    });
    form.on('submit(msg-btn)', function (data) {//发送消息
        return beauty_ajax("msg_send_utou", data.field);
    });
})