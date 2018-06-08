//弹窗添加管理员
$(function ($) {
    //弹出登录
    $("#add").on('click', function () {
        $("body").append("<div id='mask'></div>");
        $("#mask").addClass("mask").fadeIn("slow");
        $("#addBox").fadeIn("slow");
    });
    //按钮的透明度
    $("#addbtn").hover(function () {
        $(this).stop().animate({
            opacity: '1'
        }, 600);
    }, function () {
        $(this).stop().animate({
            opacity: '0.4'
        }, 1000);
    });
    //关闭
    $(".close_btn").hover(function () { $(this).css({ color: 'black' }) }, function () { $(this).css({ color: '#999' }) }).on('click', function () {
        $("#addBox").fadeOut("fast");
        $("#mask").css({ display: 'none' });
    });
});