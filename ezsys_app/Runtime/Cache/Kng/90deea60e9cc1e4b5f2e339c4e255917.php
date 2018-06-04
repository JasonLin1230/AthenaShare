<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>找回密码-验证</title>
</head>
<body>
	<form method="post" action="/index.php/User/check_captcha">
		请输入验证码：<input type='text' name='cap'/>
		<input type="submit" value="提交"/>
	</form>
</body>
</html>