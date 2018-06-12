layui.use(['jquery', 'form', 'layer','laypage'],function () {
    var form = layui.form
        , layer = layui.layer
        , laypage = layui.laypage
        , $ = layui.$;
    // 获取评论
    var kid = window.location.href.split('=')[1];
    function get_comment(){
        $.ajax({
            url: 'get_comment',
            type: "get",
            data: {
                'kid' : kid
            },
            success: function (data) {
                data = JSON.parse(data);
                if(data.code === 0){
                    var my_id=data.my_id;
                    var count=data.count;
                    data=data.data;
                    var html = '';
                    if(count == 0){
                        $('.comment ul').html("<p style='padding: 10px 0;color: #333;'>暂无评论，快发表一个吧</p>");
                    }else{
                        for (var i = 0; i < data.length; i++) {
                            if(my_id == data[i].uid){
                                html += "<li><p>"
                                    +data[i].descr
                                    + "</p><p class='layui-clear comment_note'><span>"
                                    +data[i].author
                                    +"</span>&nbsp&nbsp<a class='layui-hide layui-btn layui-btn-sm comment-del-btn' data-cid='"+data[i].cid+"'>删除评论</a><span style='float: right;'>"
                                    +data[i].dt
                                    +"</span></p></li><hr>";
                            }else{
                                html += "<li><p>"
                                    +data[i].descr
                                    + "</p><p class='layui-clear comment_note'><span>"
                                    +data[i].author
                                    +"</span><span style='float: right;'>"
                                    +data[i].dt
                                    +"</span></p></li><hr>";
                            }
                        }
                        $('.comment ul').html(html);
                        // 配置分页
                        laypage.render({
                            elem: 'comment-page'
                            ,limit: 10
                            ,count: count
                            ,jump: function(obj, first){
                                if(!first){
                                    $.ajax({
                                        url: 'get_comment',
                                        type: "get",
                                        data: {
                                            'kid' : kid,
                                            'page' : obj.curr
                                        },
                                        success: function (data) {
                                            data = JSON.parse(data);
                                            if(data.code === 0){
                                                data=data.data;
                                                var html = '';
                                                for (var i = 0; i < data.length; i++) {
                                                    if(my_id == data[i].uid){
                                                        html += "<li><p>"
                                                            +data[i].descr
                                                            + "</p><p class='layui-clear comment_note'><span>"
                                                            +data[i].author
                                                            +"</span>&nbsp&nbsp<a class='layui-hide layui-btn layui-btn-sm comment-del-btn' data-cid='"+data[i].cid+"'>删除评论</a><span style='float: right;'>"
                                                            +data[i].dt
                                                            +"</span></p></li><hr>";
                                                    }else{
                                                        html += "<li><p>"
                                                            +data[i].descr
                                                            + "</p><p class='layui-clear comment_note'><span>"
                                                            +data[i].author
                                                            +"</span><span style='float: right;'>"
                                                            +data[i].dt
                                                            +"</span></p></li><hr>";
                                                    }
                                                }
                                                $('.comment ul').html(html);
                                            }else{
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
                                }
                            }
                        });
                    }
                }else{
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
    }
    get_comment();
    // 发表评论
    form.on('submit(comment)', function (data) {//insert
        return beauty_ajax("new_comment", data.field, function () {
            get_comment();
            $("form textarea").val("");
        });
    });
    // 删除评论
    $(".comment ul").on("mouseover", "li", function () {
        $(this).find('.comment-del-btn').removeClass('layui-hide');
    });
    $(".comment ul").on("mouseout", "li", function () {
        $(this).find('.comment-del-btn').addClass('layui-hide');
    });
    $(".comment ul").on("click", "a", function () {
        var cid=$(this).attr('data-cid');
        var del_json={};
        del_json.cid=cid;
        return beauty_ajax("del_comment", del_json, function () {
            get_comment();
        });
    });
})