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
        <div class="layui-tab layui-tab-card" lay-filter="kng-tab">
            <ul class="layui-tab-title">
                <li class="layui-this">我的发布</li>
                <li>我的草稿</li>
                <li>编写最新</li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <div class="table-wrap">
                        <table id="my_share" lay-filter="my_share"></table>
                        <script type="text/html" id="operation-bar-share">
                            <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">详情</a>
                            <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="delete">删除</a>
                        </script>
                    </div>
                </div>
                <div class="layui-tab-item">
                    <div class="table-wrap">
                        <table id="draft" lay-filter="draft"></table>
                        <script type="text/html" id="operation-bar-draft">
                            <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">详情</a>
                            <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="release">发布</a>
                            <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="delete">删除</a>
                        </script>
                    </div>
                </div>
                <div class="layui-tab-item">
                    <form class="layui-form " action="">
                        <div class="layui-row">
                            <div class="layui-col-sm6">
                                <div class="layui-form-item">
                                    <label class="layui-form-label">标题</label>
                                    <div class="layui-input-block">
                                        <input type="text" name="kng_title" lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
                                    </div>
                                </div>
                            </div>
                            <div class="layui-col-sm6">
                                <div class="layui-form-item">
                                    <label class="layui-form-label">类别</label>
                                    <div class="layui-input-block">
                                        <select name="kng_cate" lay-verify="required">
                                            <option value=""></option>
                                            <?php if(is_array($getCate)): foreach($getCate as $key=>$vo): ?><option value=<?php echo ($vo["id"]); ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="layui-col-sm6">
                                <div class="layui-form-item">
                                    <label class="layui-form-label">是否分享</label>
                                    <div class="layui-input-block">
                                        <input type="radio" name="kng_sharing" value="0" title="与他人分享" checked>
                                        <input type="radio" name="kng_sharing" value="1" title="私人收藏">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <textarea id="textfield" name="kng_desc" cols="79" rows="15"></textarea>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <button class="layui-btn" lay-submit lay-filter="">发布</button>
                                <button class="layui-btn">保存</button>
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
    <script src="/AthenaShare/src/Public/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace ('textfield');
    </script>
    <script src="/AthenaShare/src/Public/js/index.js"></script>
    <script src="/AthenaShare/src/Public/js/kng.js"></script>
</div>
</body>
</html>