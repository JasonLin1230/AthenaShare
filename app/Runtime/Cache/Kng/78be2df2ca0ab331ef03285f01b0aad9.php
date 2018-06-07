<?php if (!defined('THINK_PATH')) exit();?><html>
	<head>
		<title>knowledge.</title>
		<script type="text/javascript" src="/EZSYS/src/Public/scripts/ckeditor/ckeditor.js"></script>
	</head>
	<body>
		<div id="content" name="content" contenteditable="true">
			<?php echo ($content); ?>
		</div>
		<script type="text/javascript">
			`CKEDITOR.inline ('content');
		</script>
	</body>
</html>