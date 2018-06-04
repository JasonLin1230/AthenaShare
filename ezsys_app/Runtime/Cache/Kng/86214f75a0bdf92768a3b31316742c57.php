<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<title>The master.</title>
		<link rel="stylesheet" href="/Public/index.css"></link>
	</head>
	<body>
		<h2>
			:) Ez System.
		</h2>
		<hr />
		<p>
			This is Homepage for ezsys. <br />
			Today is <i style="color:red;"><?php echo ($date); ?></i>.
		</p>
		<h4>Please input your token.</h4>
		<br />
		<form method="post" 
			action="http://10.14.4.173:81/index.php/index/login"
			onsubmit="return chk_form_format ();">
		<ul>
			<li>username : <input id="txt_usr" type="text" />
			  <i class="info_i">*</i>
			</li>
			<li>password : <input id="txt_pwd" type="text" />
			  <i class="info_i">*</i>
			</li>
			<li><input type="submit" value="Login"/>
			</li>
		</ul>
		</form>
	</body> 

	<script type="text/javascript">
		function chk_form_format () {
			var usr = document.getElementById ("txt_usr").value;
			var pwd = document.getElementById ("txt_pwd").value;
			if (usr == '' || pwd == '') {
				var i = document.getElementsByClassName ("info_i");
				i [0].style.display = "inline";
				i [1].style.display = "inline";
				return false;
			}
		}

	</script>



</html>