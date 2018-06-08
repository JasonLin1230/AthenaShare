layui.use(['element',  'layer', 'jquery','laypage'], function () {
    var element = layui.element
        , layer = layui.layer
        , laypage = layui.laypage
        , $ = layui.$;
    $.ajax({
        url: 'get_count',
        type: "get",
        success: function (data) {
            data = JSON.parse(data);
            if(data.code === 0){
                var count=data.count;
                data=data.data;
                console.log(data);
                var html = '';
                for (var i = 0; i < data.length; i++) {
                    html += "<li><h3><a href='../Kng/kng_detail.html?kid="+data[i].kid+"'>"+data[i].name+"</a></h3><div class='li_detail'>"
                        +data[i].dscr
                        + "</div><p class='layui-clear'><span class='layui-badge layui-bg-green'>"
                        +data[i].ctnm
                        +"</span><span style='float: right;'>"
                        +data[i].dt
                        +"</span></p></li>";
                }
                $('.kng_last').html(html);
                // 配置分页
                laypage.render({
                    elem: 'page'
                    ,limit: 5
                    ,count: count
                    ,jump: function(obj, first){
                        if(!first){
                            $.ajax({
                                url: 'get_count',
                                type: "get",
                                data: {
                                  'page' : obj.curr
                                },
                                success: function (data) {
                                    data = JSON.parse(data);
                                    if(data.code === 0){
                                        data=data.data;
                                        var html = '';
                                        for (var i = 0; i < data.length; i++) {
                                            html += "<li><h3><a href='../Kng/kng_detail.html?kid="+data[i].kid+"'>"+data[i].name+"</a></h3><div class='li_detail'>"
                                                +data[i].dscr
                                                + "</div><p class='layui-clear'><span class='layui-badge layui-bg-green'>"
                                                +data[i].ctnm
                                                +"</span><span style='float: right;'>"
                                                +data[i].dt
                                                +"</span></p></li>";
                                        }
                                        $('.kng_last').html(html);
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
});