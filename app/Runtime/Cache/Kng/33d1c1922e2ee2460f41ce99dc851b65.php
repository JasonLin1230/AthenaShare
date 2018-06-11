<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>AthenaShare</title>
    <link rel="icon" type="image/x-icon" href="/AthenaShare/src/Public/images/favicon.ico">
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
            <a href="../Main/main.html">首页</a>
        </li>
        <li class="layui-nav-item <?php if($nav_select == 1): ?>layui-this<?php endif; ?>">
            <a href="../Kng/kng.html">知识分享</a>
        </li>
        <li class="layui-nav-item <?php if($nav_select == 2): ?>layui-this<?php endif; ?>">
            <a href="../Message/msg.html">消息中心<?php if($new_msg_num > 0): ?><span class="layui-badge"><?php echo ($new_msg_num); ?></span><?php endif; ?></a>
        </li>
    </ul>
    <ul class="layui-nav layui-layout-right">
        <li class="layui-nav-item">
            <a href="javascript:;">
                <?php echo ($usr_name); ?>
            </a>
            <dl class="layui-nav-child">
                <dd>
                    <a href="../User/info.html">基本资料</a>
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
                    <dd class="<?php if($kng_tab == 0): ?>layui-this<?php endif; ?>">
                        <a href="../Kng/kng.html?kng_tab=0">我的发布</a>
                    </dd>
                    <dd class="<?php if($kng_tab == 1): ?>layui-this<?php endif; ?>">
                        <a href="../Kng/kng.html?kng_tab=1">我的草稿</a>
                    </dd>
                    <dd class="<?php if($kng_tab == 2): ?>layui-this<?php endif; ?>">
                        <a href="../Kng/kng.html?kng_tab=2">编写最新</a>
                    </dd>
                </dl>
            </li>
            <li class="layui-nav-item layui-nav-itemed">
                <a class="layui-icon layui-icon-notice" href="javascript:;">&nbsp;&nbsp;消息中心</a>
                <dl class="layui-nav-child">
                    <dd class="<?php if($msg_tab == 0): ?>layui-this<?php endif; ?>">
                        <a href="../Message/msg.html?msg_tab=0">已发消息</a>
                    </dd>
                    <dd class="<?php if($msg_tab == 1): ?>layui-this<?php endif; ?>">
                        <a href="../Message/msg.html?msg_tab=1">已读消息</a>
                    </dd>
                    <dd class="<?php if($msg_tab == 2): ?>layui-this<?php endif; ?>">
                        <a href="../Message/msg.html?msg_tab=2">未读消息</a>
                    </dd>
                    <dd class="<?php if($msg_tab == 3): ?>layui-this<?php endif; ?>">
                        <a href="../Message/msg.html?msg_tab=3">新建消息</a>
                    </dd>
                </dl>
            </li>
        </ul>
    </div>
</div>
    <div class="layui-body content-main" style="padding: 15px;">
        <!-- 内容主体区域 -->
        <div class="layui-tab layui-tab-card" lay-filter="msg-tab">
            <ul class="layui-tab-title">
                <li class="<?php if(($msg_tab == -1) OR ($msg_tab == 0)): ?>layui-this<?php endif; ?>">已发消息</li>
                <li class="<?php if($msg_tab == 1): ?>layui-this<?php endif; ?>">已读消息</li>
                <li class="<?php if($msg_tab == 2): ?>layui-this<?php endif; ?>">未读消息</li>
                <li class="<?php if($msg_tab == 3): ?>layui-this<?php endif; ?>">新建消息</li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item <?php if(($msg_tab == -1) OR ($msg_tab == 0)): ?>layui-show<?php endif; ?>">
                    <div class="table-wrap">
                        <table id="sent_msg" lay-filter="sent_msg"></table>
                        <script type="text/html" id="operation-bar-msg">
                            <a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="delete">删除</a>
                        </script>
                    </div>
                </div>
                <div class="layui-tab-item <?php if($msg_tab == 1): ?>layui-show<?php endif; ?>">
                    <div class="table-wrap">
                        <table id="read_msg" lay-filter="read_msg"></table>
                    </div>
                </div>
                <div class="layui-tab-item <?php if($msg_tab == 2): ?>layui-show<?php endif; ?>">
                    <div class="table-wrap">
                        <table id="unread_msg" lay-filter="unread_msg"></table>
                        <script type="text/html" id="operation-bar-unmsg">
                            <a class="layui-btn layui-btn-xs" lay-event="read">设为已读</a>
                            <a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="delete">删除</a>
                        </script>
                    </div>
                </div>
                <div class="layui-tab-item <?php if($msg_tab == 3): ?>layui-show<?php endif; ?>">
                    <form class="layui-form " action="">
                        <div class="layui-row">
                            <div class="layui-col-sm6">
                                <div class="layui-form-item">
                                    <label class="layui-form-label">接收者</label>
                                    <div class="layui-input-block">
                                        <input type="text" name="reciver" placeholder="收信人用户名" autocomplete="off" class="layui-input">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item layui-form-text">
                            <label class="layui-form-label">消息内容</label>
                            <div class="layui-input-block">
                                <textarea name="describe" placeholder="请输入内容" class="layui-textarea"></textarea>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <button class="layui-btn" lay-submit lay-filter="msg-btn">发送</button>
                                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                            </div>
                        </div>
                    </form>
                </div>
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
                    <input type="text" name="old_pass" placeholder="请输入旧密码" lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">新密码</label>
                <div class="layui-input-block">
                    <input type="password" name="new_pass" placeholder="请输入新密码" lay-verify="required|pass" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">确认密码</label>
                <div class="layui-input-block">
                    <input type="password" name="confirm_pass" placeholder="请确认新密码" lay-verify="required|pass" autocomplete="off" class="layui-input">
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
</div>
<script src="/AthenaShare/src/Public/layui/layui.js"></script>
<script src="/AthenaShare/src/Public/ckeditor/ckeditor.js"></script>
<script src="/AthenaShare/src/Public/js/base.js"></script>
<script src="/AthenaShare/src/Public/js/msg.js"></script>
</body>
</html>