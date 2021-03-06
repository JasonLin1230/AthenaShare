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
                <li class="layui-nav-item layui-this">
                    <a href="admin_usr.html" class="layui-icon layui-icon-user">&nbsp;&nbsp;用户管理</a>
                </li>
                <li class="layui-nav-item">
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
        <table id="admin-usr" lay-filter="admin-usr"></table>
        <script type="text/html" id="operation-bar-del">
            <a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="delete">删除</a>
        </script>
    </div>
    <div class="layui-footer">
        <!-- 底部固定区域 -->
        Copyright © 2018.AthenaShare
    </div>
</div>
<script src="/AthenaShare/src/Public/layui/layui.js"></script>
<script src="/AthenaShare/src/Public/js/base.js"></script>
<script src="/AthenaShare/src/Public/js/admin.js"></script>
</body>
</html>