<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>管理员登录</title>
		<link rel="shortcut icon" href="/AthenaShare/src/Public/images/favicon.ico" />
		<link rel="stylesheet" href="/AthenaShare/src/Public/css/reset.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="/AthenaShare/src/Public/css/style.css" type="text/css" media="screen" />
		<script type="text/javascript" src="/AthenaShare/src/Public/scripts/jquery-1.12.3.min.js"></script>
		<script type="text/javascript">
			var usr_valid = function (_usr) {
				if (_usr == '') return false;
				return true;
			}
			var pwd_valid = function (_pwd) {
				if (_pwd == '') return false;
				return true;
			}
			$(document).ready (function () {
					$('#usr').blur (function () {
						if (! usr_valid ($(this).val ())) {
							$(this).next ().text ('帐号不规范.').css ('display', 'inline');
						}
					}).focus (function () {
						$(this).next ().css ('display', 'none');
					});

					$('#pwd').blur (function () {
						if (! pwd_valid ($(this).val ())) {
							$(this).next ().text ('请输入密码.').css ('display', 'inline');
						}
					}).focus (function () {
						$(this).next ().css ('display', 'none');
					})
					$('form').submit (function () {
						if (usr_valid ($('#usr').val ()) && pwd_valid ($('#pwd').val ())) return true;
						else return false;
					});
			}).keypress (function (e) {
				if (e.which == 13) { // Enter press
					$('form').submit ();
				}
			})
		</script>
	</head>
	<body id="login">
		<div id="login-wrapper" class="png_bg">
			<div id="login-top">
				<h1>知识管理系统</h1>
					<!-- Logo (221px width) -->
				<a><img id="logo" src="/AthenaShare/src/Public/images/logo.png" alt="Simpla Admin logo" /></a> 
			</div>
			<div id="login-content">
				<form action="/AthenaShare/src/index.php/Admin/checklog" method="post">
					<p style="width:400px;">
						<label>帐号</label>
						<input class="text-input" name="usr" id="usr" type="text" />&nbsp;<i style="display:none;color:red;"></i>
					</p>
					<div class="clear"></div>
					<p  style="width:400px;">
						<label>密码</label>
						<input class="text-input" name="pwd" id="pwd" type="password" />&nbsp;<i style="display:none;color:red;"></i>
					</p>
					<div class="clear"></div>
				</form>
			</div>
		</div>
	</body>
</html>