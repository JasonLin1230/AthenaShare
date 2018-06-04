<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录</title>
<link rel="shortcut icon" href="/AthenaShare/src/Public/images/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="/AthenaShare/src/Public/css/reset.css" />
<link rel="stylesheet" type="text/css" href="/AthenaShare/src/Public/css/login.css" />
<link rel="Stylesheet" type="text/css" href="/AthenaShare/src/Public/css/forgetPwdDialog.css" />
<script type="text/javascript" src="/AthenaShare/src/Public/js/jquery-1.12.3.min.js"></script>
<script type="text/javascript" src="/AthenaShare/src/Public/js/sys_utils.js"></script>
<script type="text/javascript" src="/AthenaShare/src/Public/js/login.js"></script>
</head>
<body>
<div class="container">
	<section id="content">
		<form action="/AthenaShare/src/index.php/Login/checklog" method = 'post'>
			<h1>登录</h1>
			<div>
				<input type="text" placeholder="账号" id="username" name = "usr"/>
			</div>
			<div>
				<input type="password" placeholder="密码" id="password" name = "pwd"/>
			</div>
			<div>
				<!-- <input type="submit" value="Log in" /> -->
				<input type="submit" value="登录" class="btn btn-primary" id="js-btn-login"/>
				<input type="submit" value="注册" formaction = '/AthenaShare/src/index.php/Reg' />
				<a href="#" id="forget">忘记密码？</a>
				<!-- <a href="#">Register</a> -->
			</div>
		</form><!-- form -->
	</section><!-- content -->
</div>
<!-- container -->
<!-- 忘记密码 -->
<div id="ForgetBox">
<form method = 'post' action ='/AthenaShare/src/index.php/User/send_email' name='form1'>
    <div class="row1">
        密码找回<a href="javascript:void(0)" title="关闭窗口" class="close_btn" id="closeBtn">×</a>
    </div>
    <div class="row">
        账号 <span class="inputBox">
            <input type="text" id="txtName" name='usr_account' placeholder="请输入您的账号" />
        	</span><i id='acc_warn'></i>
    </div>
    <div class="row">
        邮箱 <span class="inputBox">
            <input type="text" id="txtEmail" name='usr_email' placeholder="请输入您预留的邮箱" />
        	</span><i id='ema_warn'></i>
    </div>
    <div class="row">
        <a id="forgetbtn" onclick="send_email()">找回</a>
    </div>
</form>
</div>

<br><br><br><br>
</body>
</html>