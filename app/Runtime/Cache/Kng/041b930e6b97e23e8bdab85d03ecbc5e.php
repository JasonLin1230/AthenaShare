<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class="login-html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>AthenaShare</title>
    <link rel="icon" type="image/x-icon" href="/AthenaShare/src/Public/images/favicon.ico">
    <link rel="stylesheet" href="/AthenaShare/src/Public/layui/css/layui.css">
    <link rel="stylesheet" href="/AthenaShare/src/Public/css/base.css">
</head>
<body class="login-body">
<div class="layui-fluid">
    <div class="content">
        <div class="user-login-box user-login-header">
            <h2>AthenaShare</h2>
        </div>
        <form action="" class="layui-form">
            <div class="layui-form-item">
                <label class="user-login-icon layui-icon layui-icon-username" for="user-login-username"></label>
                <input type="text" name="username" id="user-login-username" lay-verify="required|username" placeholder="用户名" class="layui-input">
            </div>
            <div class="layui-form-item">
                <label class="user-login-icon layui-icon layui-icon-password" for="user-login-password"></label>
                <input type="password" name="password" id="user-login-password" lay-verify="required|pass" placeholder="密码" class="layui-input">
            </div>
            <div class="layui-form-item">
                <label class="user-login-icon layui-icon layui-icon-password" for="user-login-password2"></label>
                <input type="password" name="password2" id="user-login-password2" lay-verify="required|pass" placeholder="确认密码" class="layui-input">
            </div>
            <div class="layui-form-item">
                <label class="user-login-icon layui-icon layui-icon-vercode" for="user-login-email"></label>
                <input type="text" name="email" id="user-login-email" lay-verify="required|email" placeholder="安全邮箱" class="layui-input">
            </div>
            <div class="layui-form-item">
                <div class="layui-row">
                    <div class="layui-col-xs7">
                        <label class="user-login-icon layui-icon layui-icon-vercode" for="user-login-valid"></label>
                        <input type="password" name="valid_email" id="user-login-valid" lay-verify="required" placeholder="邮箱验证码" class="layui-input">
                    </div>
                    <div class="layui-col-xs5">
                        <div style="margin-left: 10px;">
                            <button type="button" class="layui-btn layui-btn-primary layui-btn-fluid" id="LAY-user-getsmscode" style="height: 42px;">获取验证码</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <button class="layui-btn layui-btn-fluid layui-btn-disabled" lay-submit lay-filter="user-reg-submit" id="LAY-user-submit">注 册</button>
            </div>
            <div class="layui-form-item">
                <a href="../Login/login.html" style="float: right;">返回登录</a>
            </div>
        </form>
    </div>
</div>
<script src="/AthenaShare/src/Public/layui/layui.js"></script>
<script src="/AthenaShare/src/Public/js/base.js"></script>
<script src="/AthenaShare/src/Public/js/login.js"></script>
<script>
    document.getElementsByClassName("login-body")[0].style.backgroundImage='url(http://img.infinitynewtab.com/wallpaper/' + Math.floor(Math.random()*4050) + '.jpg)';
</script>
</body>
</html>