<?php if (!defined('THINK_PATH')) exit();?><html><body>
	<form action="/index.php/Upload/upload" enctype="multipart/form-data" method="post" >
    <input type="text" name="name" />
    <input type="file" name="photo" />
    <input type="submit" value="提交" >
    </form>

</body></html>