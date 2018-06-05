<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>AthenaShare</title>
    <link rel="stylesheet" href="/AthenaShare/src/Public/layui/css/layui.css">
    <link rel="stylesheet" href="/AthenaShare/src/Public/css/base.css">
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
    <div class="layui-logo">AthenaShare</div>
    <!-- 头部区域-->
    <ul class="layui-nav layui-layout-left">
        <li class="layui-nav-item">
            <a href="../Main/index.html">首页</a>
        </li>
        <li class="layui-nav-item">
            <a href="../Kng/kng">知识分享</a>
        </li>
        <li class="layui-nav-item">
            <a href="../Message/msg">消息中心</a>
        </li>
        <li class="layui-nav-item">
            <a href="../Src/src">资源管理</a>
        </li>
    </ul>
    <ul class="layui-nav layui-layout-right">
        <li class="layui-nav-item">
            <a href="javascript:;">
                <!--<?php echo (session('usr_name')); ?>-->
                <?php echo ($usr_name); ?>
            </a>
            <dl class="layui-nav-child">
                <dd>
                    <a href="../User/info">基本资料</a>
                </dd>
                <dd>
                    <a href="javascript:;" id="password-btn">修改密码</a>
                </dd>
                <hr>
                <dd>
                    <a href="../login/logout">注销</a>
                </dd>
            </dl>
        </li>
    </ul>
</div>
<div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
        <!-- 左侧导航区域 -->
        <ul class="layui-nav layui-nav-tree" lay-filter="test">
            <li class="layui-nav-item layui-nav-itemed">
                <a class="layui-icon layui-icon-read" href="javascript:;">&nbsp;&nbsp;知识分享</a>
                <dl class="layui-nav-child">
                    <dd>
                        <a href="../Kng/kng">我的发布</a>
                    </dd>
                    <dd>
                        <a href="">我的草稿</a>
                    </dd>
                    <dd>
                        <a href="">编写最新</a>
                    </dd>
                </dl>
            </li>
            <li class="layui-nav-item layui-nav-itemed">
                <a class="layui-icon layui-icon-notice" href="javascript:;">&nbsp;&nbsp;消息中心</a>
                <dl class="layui-nav-child">
                    <dd>
                        <a href="../Message/msg">已发消息</a>
                    </dd>
                    <dd>
                        <a href="">已读消息</a>
                    </dd>
                    <dd>
                        <a href="">未读消息</a>
                    </dd>
                    <dd>
                        <a href="">新建消息</a>
                    </dd>
                </dl>
            </li>
            <li class="layui-nav-item layui-nav-itemed">
                <a class="layui-icon layui-icon-component" href="javascript:;">&nbsp;&nbsp;资源管理</a>
                <dl class="layui-nav-child">
                    <dd>
                        <a href="../Src/src">私有资源</a>
                    </dd>
                    <dd>
                        <a href="">共享资源</a>
                    </dd>
                    <dd>
                        <a href="">新建资源</a>
                    </dd>
                </dl>
            </li>
        </ul>
    </div>
</div>
    <div class="layui-body content-main" style="padding: 15px;">
        <!-- 内容主体区域 -->
        <div class="layui-fluid">
            <h2 class="kng_title">标题</h2>
            <ul class="min-font">
                <li>类别：Unix</li>
                <li>时间：2018年7月31日</li>
                <li>作者：JasonLin</li>
                <li>获赞：77</li>
            </ul>
            <div style="text-align: right;">
                <button type="button" class="layui-btn">
                    <i class="layui-icon">&#xe6c6;</i>点赞
                </button>
                <button type="button" class="layui-btn">
                    <i class="layui-icon">&#xe857;</i>下载文件
                </button>
            </div>
            <div class="kng_content">
                历经打磨，@索尼中国 再献新作品—OLED电视A8F完美诞生。很开心一起参加了A8F的“首映礼”！[鼓掌]正如我们演员对舞台的热爱，索尼对科技与艺术的追求才创造出了让人惊喜的作品。作为A1兄弟款，A8F沿袭了黑科技“屏幕发声技术”和高清画质，色彩的出众表现和高端音质，让人在体验的时候如同身临其境。A8F，这次的“视帝”要颁发给你！ 索尼官网预售： O网页链接 索尼旗舰店预售：
                历经打磨，@索尼中国 再献新作品—OLED电视A8F完美诞生。很开心一起参加了A8F的“首映礼”！[鼓掌]正如我们演员对舞台的热爱，索尼对科技与艺术的追求才创造出了让人惊喜的作品。作为A1兄弟款，A8F沿袭了黑科技“屏幕发声技术”和高清画质，色彩的出众表现和高端音质，让人在体验的时候如同身临其境。A8F，这次的“视帝”要颁发给你！ 索尼官网预售： O网页链接 索尼旗舰店预售：
            </div>

        </div>
    </div>
    <div class="layui-footer">
    <!-- 底部固定区域 -->
    Copyright © 2018.AthenaShare
</div>
<script type="text/html" id="passwordTp">
    <div id="password">
        <form class="layui-form " method="post" action="#" style="padding: 15px 20px 0 0;">
            <div class="layui-form-item">
                <label class="layui-form-label">旧密码</label>
                <div class="layui-input-block">
                    <input type="text" name="old_pass" placeholder="请输入旧密码" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">新密码</label>
                <div class="layui-input-block">
                    <input type="password" name="new_pass" placeholder="请输入新密码" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">确认密码</label>
                <div class="layui-input-block">
                    <input type="password" name="confirm_pass" placeholder="请确认新密码" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item" style="margin-top: 15px;">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="password">立即提交</button>
                </div>
            </div>
        </form>
    </div>
</script>
    <script src="/AthenaShare/src/Public/layui/layui.js"></script>
    <script src="/AthenaShare/src/Public/js/index.js"></script>
    <script src="/AthenaShare/src/Public/js/kng.js"></script>
</div>
</body>
</html>