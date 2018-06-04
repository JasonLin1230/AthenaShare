<?php if (!defined('THINK_PATH')) exit();?><html>
	<head>
		<title>push_draft</title>
	</head>
	<body>
		<form method='post' action='/index.php/Src/upload_src'>
		  <fieldset>
		    <p>
		      <label>上传资源</label>
	        <input type="text" id="txt_srcname"/>
	        <input type="file" name="src_file"/>
		      <br />
		      <small>为你的文件起个名字吧</small> 
			  </p>
	        <p>
	          <label>愿与所有人分享吗？</label>
	          <input type="radio" name="src_sharing" id="src_sharing" value="1"/>
	          	与他人分享<br />
	          <input type="radio" name="src_sharing" id="src_sharing" checked="checked" value="0" />
							私人收藏
	        </p>
	        <p>
						<label>主体部分</label>
	          <textarea class="text-input textarea" id="txt_srcdesc" name="txt_srcdesc" cols="79" rows="15"></textarea>
	        </p>
	        <p>
	          <input class="button" type="submit" value="发射" />
	        </p>
		  </fieldset>
		</form>
	</body>
</html>