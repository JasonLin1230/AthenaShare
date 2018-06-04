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
			action="/index.php/Reg/checkreg"
			onsubmit="return chk_form_format ();">
		<ul>
			<li>username : <input id="usr" name="usr" type="text" />
			  <i class="info_i">*</i>
			</li>
			<li>password : <input name="pwd" id="pwd" type="password" />
			  <i class="info_i">*</i>
			</li>
			<li>repassword : <input name="repwd" id="repwd" type="password" />
			  <i class="info_i">*</i>
			</li>
			<li>realname : <input name="realname" id="realname" type="text" />
			  <i class="info_i">*</i>
			</li>
			<li>man : <input name="sex" checked="checked" type="radio" value=1 />
				<br/>woman : <input name="sex" type="radio" value=0 />
			</li>
			<li><input type="submit" value="Register"/>
			</li>
		</ul>
		</form>
	</body> 

	<script type="text/javascript">
		function chk_form_format () {
			var usr = document.getElementById ("usr").value;
			var pwd = document.getElementById ("pwd").value;
			var repwd = document.getElementById ("repwd").value;
			var realname = document.getElementById ("realname").value;
			if (usr == '' || pwd == '' || repwd == '' || realname == '') {
				var i = document.getElementsByClassName ("info_i");
				i [0].style.display = "inline";
				i [1].style.display = "inline";
				i [2].style.display = "inline";
				i [3].style.display = "inline";
				return false;
			}
		}
	</script>



</html>