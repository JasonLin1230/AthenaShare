<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>找回密码-重设</title>
</head>
<body>
	<form method='post' action='/index.php/User/new_passcode'>
		请输入新密码：<input type='password' id='p2' size='20' name='new_passcode'/>
		<br/>
		请再次输入新密码：<input type='password' id='p2' size='20'/>
		<br/>
		<input type='submit' value='提交'/>
	</form>
</body>
</html>