<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class="login-html">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>AthenaShare</title>
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
				<input type="text" name="username" id="user-login-username" lay-verify="required" placeholder="用户名" class="layui-input">
			</div>
			<div class="layui-form-item">
				<label class="user-login-icon layui-icon layui-icon-password" for="user-login-password"></label>
				<input type="password" name="password" id="user-login-password" lay-verify="required" placeholder="密码" class="layui-input">
			</div>
			<div class="layui-form-item">
				<button class="layui-btn layui-btn-fluid" lay-submit lay-filter="user-login-submit">登 入</button>
			</div>
			<div class="layui-form-item">
				<a href="javascript:;" id="forgetpass-btn">忘记密码</a>
				<a href="../Reg/index.html" style="float: right;">注册</a>
			</div>
		</form>
	</div>
</div>
<script type="text/html" id="forgetpass">
	<div>
		<form class="layui-form " method="post" action="#" style="padding: 15px 20px 0;">
			<div class="layui-form-item">
				<input type="text" name="usr_account" placeholder="请输入您的账号" autocomplete="off" lay-verify="required" class="layui-input">
			</div>
			<div class="layui-form-item">
				<input type="text" name="usr_email" placeholder="请输入您的预留邮箱" autocomplete="off" lay-verify="required" class="layui-input">
			</div>
			<div class="layui-form-item" style="margin-top: 15px;">
				<div class="layui-input-block">
					<button class="layui-btn" lay-submit lay-filter="forgetpass">立即提交</button>
				</div>
			</div>
		</form>
	</div>
</script>
<script src="/AthenaShare/src/Public/layui/layui.js"></script>
<script src="/AthenaShare/src/Public/js/base.js"></script>
<script src="/AthenaShare/src/Public/js/login.js"></script>
<script>
	document.getElementsByClassName("login-body")[0].style.backgroundImage='url(http://img.infinitynewtab.com/wallpaper/' + Math.floor(Math.random()*4050) + '.jpg)';
</script>
</body>
</html>