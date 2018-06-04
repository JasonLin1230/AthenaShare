<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>知识管理系统</title>
		<link rel="stylesheet" href="/Public/css/reset.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="/Public/css/style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="/Public/css/invalid.css" type="text/css" media="screen" />
		<script type="text/javascript" src="/Public/scripts/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="/Public/scripts/simpla.jquery.configuration.js"></script>
		<script type="text/javascript" src="/Public/ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="/Public/scripts/facebox.js"></script>
		<script type="text/javascript" src="/Public/scripts/jquery.wysiwyg.js"></script>
		<script type="text/javascript" src="/Public/scripts/jquery.datePicker.js"></script>
		<script type="text/javascript" src="/Public/scripts/jquery.date.js"></script>
	</head>
<body>
	<div id="body-wrapper">
	  <!-- Wrapper for the radial gradient background -->
	  <div id="sidebar">
	    <div id="sidebar-wrapper">
	      <!-- Sidebar with logo and menu -->
	      <h1 id="sidebar-title"><a href="#">个人管理</a></h1>
	      <!-- Logo (221px wide) -->
	      <a href="#"><img id="logo" src="/Public/images/logo.png" alt="Simpla Admin logo" /></a>
	      <!-- Sidebar Profile links -->
	      <div id="profile-links"> 
					您好, <a href="#" title="Edit your profile"><?php echo ($usr_name); ?></a>, 
					您有<a href="#messages" rel="modal" title="新消息"><?php echo ($new_msg_num); ?>条新消息</a>
					<br />
	        <br />
	        <a href="#" title="进入主页">主页</a> | 
					<a href="/index.php/login/logout" title="注销">退出</a> 
				</div>
	      <ul id="main-nav">
	        <!-- Accordion Menu -->
	        <li> <a href="#" class="nav-top-item <?php echo ($current_out1); ?>">知识管理</a>
						<ul>
							<li><a href="/index.php/index/personal_kng_mine" class="<?php echo ($current_in1); ?>">我的发布</a></li>
							<li><a href="/index.php/index/personal_kng_script" class="<?php echo ($current_in2); ?>">我的草稿</a></li>
						</ul>
					</li>
	        <li> <a href="#" class="nav-top-item">消息管理</a>
	          <ul>
							<li><a href="#">所有消息</a></li>
	            <li><a href="#">新消息</a></li>
	            <li><a href="#">已读消息</a></li>
	          </ul>
	        </li>
	        <li> <a href="#" class="nav-top-item <?php echo ($current_out2); ?>">资源管理</a>
	          <ul>
	          	<li><a href="/index.php/index/personal_src_mine" class="<?php echo ($current_in4); ?>">私有资源</a></li>
	            <li><a href="/index.php/index/personal_src_share" class="<?php echo ($current_in3); ?>">共享资源</a></li>
	          </ul>
	        </li>
	        <li> <a href="#" class="nav-top-item">个人管理</a>
	          <ul>
	            <li><a href="#">个人信息</a></li>
	            <li><a href="#">密码管理</a></li>
	          </ul>
	        </li>
	        <li> <a href="#" class="nav-top-item">关于</a>
	          <ul>
	            <li><a href="#">使用规则</a></li>
	            <li><a href="#">开发者</a></li>
	            <li><a href="#">本系统</a></li>
	          </ul>
	        </li>
					<!--
	        <li> <a href="#" class="nav-top-item"> Settings </a>
	          <ul>
	            <li><a href="#">General</a></li>
	            <li><a href="#">Design</a></li>
	            <li><a href="#">Your Profile</a></li>
	            <li><a href="#">Users and Permissions</a></li>
	          </ul>
	        </li>
					-->
	      </ul>
      <!-- End #main-nav -->
    		</div>
  		</div>
  <!-- End #sidebar -->
		</div>
		<!--block-->
		
  	<div id="main-content">
  	  <!-- Main Content Section with everything -->
  	  <noscript>
  	  	<!-- Show a notification if the user has disabled javascript -->
  	  	<div class="notification error png_bg">
  	  	  <div> 
						Javascript is disabled or is not supported by your browser. Please 
						<a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or 
						<a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> 
						Javascript to navigate the interface properly.
  	  	    Download From <a href="http://www.exet.tk">exet.tk</a>
					</div>
  	  	</div>
  	  </noscript>
  	  <!-- Page Head -->
  	  <h2>欢迎登录系统</h2>
  	  <p id="page-intro">想做点什么？</p>
			<!-- xxxxxxxxxxxxxxxxxxxxxxxxxxx -->
			

		<div class="content-box">
    	  <!-- Start Content Box -->
    	  <div class="content-box-header">
    	    <h3>资源</h3>
    	    <ul class="content-box-tabs">
    	      <li><a href="#tab1" class="default-tab"><?php echo ($menu); ?>资源</a></li>
    	      <li><a href="#tab2">上传</a></li>
    	    </ul>
    	    <div class="clear"></div>
    	  </div>
    	  <!-- End .content-box-header -->
    	  <div class="content-box-content">
    	    <div class="tab-content default-tab" id="tab1">
    	      <!-- This is the target div. id must match the href of this div's tab -->
						<div class="notification information png_bg"> 
							<a href="#" class="close"><img src="/Public/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
    	  			<div> 
								<?php if(($num > 0)): ?>这是您目前上传的资源, 按时间排序, 当前在<b>第<?php echo ($current_page+1); ?>页</b>.
								<?php else: ?>
									您目前还没有上传任何资源呢 :(<?php endif; ?>
							</div>
    				</div>
    	      <table>
    	        <thead>
    	          <tr>
    	            <th>标题</th>
    	            <th>时间</th>
    	            <th>摘要</th>
    	            <th>操作</th>
    	          </tr>
    	        </thead>
    	        <tfoot>
    	          <tr>
    	            <td colspan="6">
    	              <div class="pagination"> 
											<a href="/index.php/index/personal_src_mine?pga=0" title="First Page">&laquo;首页</a>
											<a href="/index.php/index/personal_src_mine?pga=<?php echo ($former_page); ?>" title="Previous Page">&laquo;上一页</a> 
											<?php if(is_array($page_list)): $i = 0; $__LIST__ = $page_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><a href="/index.php/index/personal_src_mine?pga=<?php echo ($p); ?>" class="number" title="<?php echo ($p); ?>"><?php echo ($p+1); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
											<a href="/index.php/index/personal_src_mine?pga=<?php echo ($next_page); ?>" title="Next Page">下一页&raquo;</a>
											<a href="/index.php/index/personal_src_mine?pga=<?php echo ($last_page); ?>" title="Last Page">尾页&raquo;</a> 
										</div>
    	              <div class="clear"></div>
    	            </td>
    	          </tr>
    	        </tfoot>
    	        <tbody>
								<?php if(is_array($src_list)): $i = 0; $__LIST__ = $src_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$k): $mod = ($i % 2 );++$i;?><tr>
    	            <td><a href="#" title="<?php echo ($k["src_name"]); ?>"><?php echo ($k["src_id"]); ?>.<?php echo (mb_substr($k["src_name"],0,14)); ?>...
										</a>
									</td>
    	            <td><a title="发布时间"><?php echo ($k["src_update_date"]); ?>
										</a>
									</td>
    	            <td><?php echo (mb_substr($k["src_describe"],0,20)); ?>...</td>
    	            <td>
										<a href="/index.php/index/delete_src?kid=<?php echo ($k["src_id"]); ?>" title="Delete">
											<img src="/Public/images/icons/cross.png" 
											alt="删除" />
										</a> 
										<a href="#" title="分享">
											<img src="/Public/images/icons/hammer_screwdriver.png" 
											alt="分享" />
										</a> 
									</td>
    	          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    	        </tbody>
    	      </table>
    	    </div>
    	    <!-- End #tab1 -->
    	    <div class="tab-content" id="tab2">
    	      <form action="/index.php/index/upload_src" enctype="multipart/form-data" method="post">
    	        <fieldset>
    	        <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
    	        <p>
    	          <label>上传资源</label>
                    <input type="text" name="src_name" />
                    <input class="button" type="file" name="file" />
                    
    	            <br />
    	            <small>为你的文件起个名字吧</small> 
							</p>
        	        <p>
        	          <label>愿与所有人分享吗？</label>
        	          <input type="radio" name="sharing" value="1" />
        	          	与他人分享<br />
        	          <input type="radio" name="sharing" checked="checked" value="0" />
    									私人收藏
        	        </p>
        	        <p>
    								<label>主体部分</label>
        	          <textarea class="text-input textarea wysiwyg" id="textfield" name="src_desc" cols="79" rows="15"></textarea>
        	        </p>
        	        <p>
        	          <input class="button" type="submit" value="发射" />
        	        </p>
    	        </fieldset>
    	        <div class="clear"></div>
    	        <!-- End .clear -->
    	      </form>
    	    </div>
    	    <!-- End #tab2 -->
    	  </div>
    	  <!-- End .content-box-content -->
    	</div>
    	<div class="clear"></div>
    	<!-- Start Notifications -->
    	
    	    <!-- End Notifications -->
  <!-- End #main-content -->
			<!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
    	<div id="footer"> 
				<small>&#169; Copyright 2016 xxx Company | Powered by 
					<a href="http://dreamtech.club">NCEPU Dre@mtech</a> | 
					<a href="#">Top</a> 
				</small> 
			</div>
		</div>
	</body>
<!-- Download From www.exet.tk-->
</html>