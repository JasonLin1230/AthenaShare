<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>知识管理系统</title>
		<link rel="stylesheet" href="/Public/css/reset.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="/Public/css/style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="/Public/css/invalid.css" type="text/css" media="screen" />
		<script type="text/javascript" src="/Public/scripts/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="/Public/scripts/simpla.jquery.configuration.js"></script>
		<script type="text/javascript" src="/Public/scripts/facebox.js"></script>
		<script type="text/javascript" src="/Public/scripts/jquery.wysiwyg.js"></script>
	</head>
	<body id="login">
		<div id="login-wrapper" class="png_bg">
			<div id="login-top">
				<h1>知识管理系统</h1>
					<!-- Logo (221px width) -->
				<a><img id="logo" src="/Public/images/logo.png" alt="Simpla Admin logo" /></a> 
			</div>
				<!-- End #logn-top -->
			<div id="login-content">
				<form action="http://10.14.4.173:81/index.php/index/login" method="post">
					<div class="notification information png_bg">
						<div> Just click "Sign In". No password needed. </div>
					</div>
					<p>
						<label>帐号</label>
						<input class="text-input" type="text" />
					</p>
					<div class="clear"></div>
					<p>
						<label>密码</label>
						<input class="text-input" type="password" />
					</p>
					<div class="clear"></div>
					<p id="remember-password">
						<input type="checkbox" />记住我
					</p>
					<div class="clear"></div>
					<p>
						<input class="button" type="submit" value="Sign In" />
					</p>
				</form>
			</div>
<!-- End #login-content -->
		</div>
<!-- End #login-wrapper -->
	</body>
</html>