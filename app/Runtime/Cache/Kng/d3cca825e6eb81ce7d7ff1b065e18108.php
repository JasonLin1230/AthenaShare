<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>AthenaShare</title>
    <link rel="icon" type="image/x-icon" href="/AthenaShare/src/Public/images/favicon.ico">
    <link rel="stylesheet" href="/AthenaShare/src/Public/layui/css/layui.css">
    <link rel="stylesheet" href="/AthenaShare/src/Public/css/admin.css">
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-admin-logo">AthenaShare</div>
    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <ul class="layui-nav layui-nav-tree">
                <li class="layui-nav-item">
                    <a href="index.html">管理中心</a>
                </li>
                <li class="layui-nav-item">
                    <a href="admin_usr.html" class="layui-icon layui-icon-user">&nbsp;&nbsp;用户管理</a>
                </li>
                <li class="layui-nav-item layui-this">
                    <a href="admin_kng.html" class="layui-icon layui-icon-read">&nbsp;&nbsp;知识管理</a>
                </li>
                <li class="layui-nav-item">
                    <a href="admin_msg.html" class="layui-icon layui-icon-notice">&nbsp;&nbsp;消息管理</a>
                </li>
                <li class="layui-nav-item">
                    <a href="../AdminLogin/logout">注销</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="layui-body content-main" style="padding: 15px;top: 0;">
        <!-- 内容主体区域 -->
        <div class="btn-wrap" style="text-align: right;">
            <button class="layui-btn new-cate-btn">新增分类</button>
        </div>
        <table id="admin-kng" lay-filter="admin-kng"></table>
        <script type="text/html" id="operation-bar-del">
            <a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="delete">删除</a>
        </script>
    </div>
    <div class="layui-footer">
        <!-- 底部固定区域 -->
        Copyright © 2018.AthenaShare
    </div>
</div>
<script type="text/html" id="new-cate">
    <div>
        <form class="layui-form " method="post" action="#" style="padding: 15px 20px 0 0;">
            <div class="layui-form-item">
                <label class="layui-form-label">类别</label>
                <div class="layui-input-block">
                    <input type="text" name="catename" placeholder="请输入类别名称" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item" style="margin-top: 15px;">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="new-cate">立即提交</button>
                </div>
            </div>
        </form>
    </div>
</script>
<script src="/AthenaShare/src/Public/layui/layui.js"></script>
<script src="/AthenaShare/src/Public/js/base.js"></script>
<script src="/AthenaShare/src/Public/js/admin.js"></script>
</body>
</html>