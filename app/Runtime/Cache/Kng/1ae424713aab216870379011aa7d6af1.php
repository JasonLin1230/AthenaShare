<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>管理员登录</title>
	<link rel="stylesheet" href="/AthenaShare/src/Public/css/admin.css">
</head>
<body id="login">
	<div id="login-wrapper">
		<div id="login-top">
			<h1>AthenaShare</h1>
		</div>
		<div id="login-content">
			<form action="/AthenaShare/src/index.php/Admin/checklog" method="post" id="form">
				<p>
					<label>帐号</label>
					<input class="text-input" name="usr" id="usr" type="text" required />
				</p>
				<p>
					<label>密码</label>
					<input class="text-input" name="pwd" id="pwd" type="password" required />
				</p>
			</form>
		</div>
	</div>
</body>
<script type="text/javascript">
    document.onkeydown=function(event) {
        var e = event || window.event;
        if (e.keyCode == 13) { // Enter press
            document.getElementById('form').submit();
        }
    }
</script>
</html>