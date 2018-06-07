<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>系统注册</title>
	<meta http-equiv="content-Type" content="text/html" charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="/EZSYS/src/Public/css/signup.css" />
	<link rel="shortcut icon" href="/EZSYS/src/Public/images/favicon.ico" />
	
	<script type="text/javascript" src="/EZSYS/src/Public/scripts/jquery-1.12.3.min.js"></script>
	<script type="text/javascript" src="/EZSYS/src/Public/scripts/sys_utils.js"></script>
	<script type="text/javascript" src="/EZSYS/src/Public/scripts/signup.js"></script>

</head>
<body>
	<div class="content">
		<div class="ucSimpleHeader">
			<a href="##" class="meizuLogo"></a>
			<div class="trigger">
				<a href="/EZSYS/src/index.php/Login">登录</a>
				<span>&nbsp;|&nbsp;</span>
				<a href="/EZSYS/src/index.php/Main/main_page">主页</a>
			</div>
		</div>
		<form id="#mainForm2" class="mainForm mainForm1">
			<div class="number">
				<a href="" class="linkAGray2">账户名注册</a>
			</div>
			<div class="normalInput">
				<input type="text" class="username" maxlength="32" placeholder="账户名" autocomplete="off">	
			</div>
			<span class="error error1"></span>		
			<div class="normalInput">
				<input type="text" class="passwordN" maxlength="16" autocomplete="off" placeholder="密码">
				<input type="password" class="password1N" maxlength="16" autocomplete="off" placeholder="密码">
				<a id="pwdBtnN" href="##" class="pwdBtnShowN" isshow="false">
					<i class="i_icon"></i>
				</a>
			</div>
			<span class="error error3"></span>
			<div class="normalInput">
				<input type="text" class="email" maxlength="32" placeholder="安全邮箱" autocomplete="off">
			</div>
			<span class="error error2"></span>
			<div class="rememberField">
				<span class="checkboxPic check_chk" tabindex="-1" isshow="false">
					<i class="i_icon"></i>
				</span>
				<label class="pointer">我已阅读并接受</label>
				<a href="#" target="_blank" class="linkABlue">《知识管理系统使用规则》</a>
			</div>
			<span class="otherError">请确认已阅读并同意系统使用规则</span>
			<a class="fullBtnBlue">注册</a>
		</form>
	</div>
	
	</div>
	<ul class="bRadius2 mail">
		<li data-mail="@qq.com" class="item item1">@qq.com</li>
		<li data-mail="@sina.com" class="item item2">@sina.com</li>
		<li data-mail="@126.com" class="item item3">@126.com</li>
		<li data-mail="@163.com" class="item item4">@163.com</li>
		<li data-mail="@gmail.com" class="item item5">@gmail.com</li>
	</ul>
	<div id="mz_Float">
		<div class="mz_FloatBox">
			<div class="mz3AngleL">
				<i class="i_icon"></i>
			</div>
			<div class="mzFloatTip bRadius2">长度为8-16个字符，区分大小写，至少包含两种类型</div>
		</div>
	</div>
	<div style="text-align:center;"></div>
</body>
</html>