<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>找回密码-邮箱</title>
</head>
<body>
	<form method="post" action="/index.php/User/send_email">  
    请输入用户名 ：<input name="usr_account" type="text" id="usr_account" size="30"/>  
    <br/>
    请输入预留邮箱 ：<input name="usr_email" type="email" id="usr_email" size="30"/>  
	<br/>
    <input type="submit" name="Submit" value=" 确定找回 " />  

    </form>  
</body>
</html>