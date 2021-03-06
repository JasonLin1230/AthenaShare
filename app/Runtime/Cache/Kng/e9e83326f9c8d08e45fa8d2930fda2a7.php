<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>AthenaShare</title>
    <link rel="stylesheet" href="/AthenaShare/src/Public/layui/css/layui.css">
    <style>
        body{
            background-color: #f2f2f2;
        }
        .layadmin-tips {
            margin-top: 30px;
            text-align: center;
        }
        .layadmin-tips .layui-icon[face] {
            display: inline-block;
            font-size: 300px;
            color: #393D49;
        }
        .layadmin-tips .layui-text {
            width: 500px;
            margin: 30px auto;
            padding-top: 20px;
            border-top: 5px solid #009688;
            font-size: 16px;
        }
        .layadmin-tips h1 {
            font-size: 100px;
            line-height: 100px;
            color: #009688;
        }
        .layadmin-tips .layui-text .layui-anim {
            display: inline-block;
        }
    </style>
</head>
<body>
<div class="layui-fluid">
    <div class="layadmin-tips">
        <i class="layui-icon" face=""></i>
        <div class="layui-text">
            <h1>
                <span class="layui-anim layui-anim-loop layui-anim-">4</span>
                <span class="layui-anim layui-anim-loop layui-anim-rotate">0</span>
                <span class="layui-anim layui-anim-loop layui-anim-">4</span>
            </h1>
        </div>
    </div>
</div>
<script src="/AthenaShare/src/Public/layui/layui.js"></script>
<script src="/AthenaShare/src/Public/js/index.js"></script>
</body>
</html>