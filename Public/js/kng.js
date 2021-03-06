layui.use(['element', 'form', 'table', 'layer','upload', 'laypage','jquery'], function () {
    var element = layui.element
        , form = layui.form
        , table = layui.table
        , layer = layui.layer
        , upload = layui.upload
        , laypage = layui.laypage
        , $ = layui.$;
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
        , height: 400
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
        , height: 400
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
            window.location='kng_detail.html?kid='+data.kid;
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
    $(".layui-btn.like-btn").click(function () {
        var post_json={};
        post_json.kid=$(this).attr('data-kid');
        $.ajax({
            url: "like_kng",
            type: "post",
            dataType: "json",
            data: post_json,
            success: function (data) {
                // data = JSON.parse(data);
                if(data.code === 0){
                    var cur_like=parseInt($(".min-font .like").html());
                    $(".min-font .like").html(cur_like+1);
                }else {
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
                layer.msg(XMLHttpRequest.status + '操作失败', {
                    icon: 2
                    , shade: 0.1
                    , time: 2000
                })
            },
            complete: function (XMLHttpRequest, textStatus) {
                this;
            }
        });
    });
    form.on('submit(kng-release)', function (data) {//发布
        data.field['is_script']='0';
        var kng_desc=CKEDITOR.instances.textfield.getData();
        if(kng_desc == ''){
            layer.msg('内容不能为空', {
                icon: 2
                , shade: 0.1
                , time: 2000
            });
            return false;
        }
        data.field['kng_desc']=CKEDITOR.instances.textfield.getData();
        return beauty_ajax("insert_kng", data.field);
    });
    form.on('submit(kng-save)', function (data) {//保存
        data.field['is_script']='1';
        var kng_desc=CKEDITOR.instances.textfield.getData();
        if(kng_desc == ''){
            layer.msg('内容不能为空', {
                icon: 2
                , shade: 0.1
                , time: 2000
            });
            return false;
        }
        data.field['kng_desc']=CKEDITOR.instances.textfield.getData();
        return beauty_ajax("insert_kng", data.field);
    });
    form.on('submit(kng-insert)', function (data) {//insert
        var kng_desc=CKEDITOR.instances.textfield.getData();
        if(kng_desc == ''){
            layer.msg('内容不能为空', {
                icon: 2
                , shade: 0.1
                , time: 2000
            });
            return false;
        }
        data.field['kng_desc']=CKEDITOR.instances.textfield.getData();
        return beauty_ajax("insert_kng", data.field);
    });
    var uploadSrc = upload.render({
        elem: '#upsrc' //绑定元素
        ,url: 'upload' //上传接口
        ,field: 'file'
        ,auto: false
        ,bindAction: '.upload-btn'
        ,accept: 'file' //普通文件
        ,exts: 'zip|rar|7z' //只允许上传压缩文件
        ,choose: function(obj){
            $(".hasfile").removeClass("layui-hide");
            $(".nofile").addClass("layui-hide");
        }
        ,before: function () {
            layer.msg('正在提交',{
                icon: 16
                ,shade: 0.1
                ,time: 0
            });
        }
        ,done: function(data){
            if (data.code === 0) {
                $("input[name='file_name']").val(data.file_name);
                $("input[name='file_path']").val(data.file_path);
                $("#insert").click();
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
        }
        ,error: function(){
            layer.open({
                title: '上传失败'
                ,content: '是否重新删除上传？'
                ,btn: ['是', '否']
                ,yes: function(index, layero){
                    uploadSrc.upload();
                }
            });
        }
    });
})