<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>知识管理系统</title>
		<link rel="stylesheet" href="/AthenaShare/src/Public/css/reset.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="/AthenaShare/src/Public/css/style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="/AthenaShare/src/Public/css/personal.css" type="text/css" media="screen" />
		<link rel="shortcut icon" href="/AthenaShare/src/Public/images/favicon.ico" />
		<script type="text/javascript" src="/AthenaShare/src/Public/scripts/jquery-1.12.3.min.js"></script>
		<script type="text/javascript" src="/AthenaShare/src/Public/ckeditor/ckeditor.js"></script>
		<!--<script type="text/javascript" src="/AthenaShare/src/Public/scripts/facebox.js"></script>-->
		<!--<script type="text/javascript" src="/AthenaShare/src/Public/scripts/jquery.datePicker.js"></script>-->
		<!--<script type="text/javascript" src="/AthenaShare/src/Public/scripts/jquery.date.js"></script>-->
		<script type="text/javascript" src="/AthenaShare/src/Public/scripts/sys_utils.js"></script>
		<script type="text/javascript" src="/AthenaShare/src/Public/scripts/float_box.js"></script>
		<script type="text/javascript" src="/AthenaShare/src/Public/scripts/personal.js"></script>
	</head>
<body>
	<div id="body-wrapper">
	  <!-- Wrapper for the radial gradient background -->
	  <div id="sidebar">
	    <div id="sidebar-wrapper">
	      <!-- Sidebar with logo and menu -->
	      <h1 id="sidebar-title"><a href="#">个人管理</a></h1>
	      <!-- Logo (221px wide) -->
	      <a href="#"><img id="logo" src="/AthenaShare/src/Public/images/logosmall.png" alt="Simpla Admin logo" /></a>
	      <!-- Sidebar Profile links -->
	      <div id="profile-links"> 
					您好, <a id="usr_name"><?php echo ($usr_name); ?></a>, 
					您有<a title="新消息" id="unread_msg"><?php echo ($new_msg_num); ?>条新消息</a>
					<br />
	        <br />
	        <a href="/AthenaShare/src/index.php/Main/main_page" title="进入主页">主页</a> | 
			<a href="/AthenaShare/src/index.php/login/logout" title="注销">退出</a>
		  </div>
	      <ul id="main-nav">
	        <!-- Accordion Menu -->
	        <li> <a class="nav-top-item">知识管理</a>
				<ul>
					<li><a id="my_pub_kng" onclick="personal_kng_mine ();">我的发布</a></li>
					<li><a id="my_script_kng" onclick="personal_script_mine ()">我的草稿</a></li>
					<li><a id="my_new_kng" onclick="personal_kng_new ();">编写最新</a></li>
				</ul>
			</li>
	        <li> <a class="nav-top-item">消息管理</a>
	          <ul>
				<li><a onclick="personal_send_msg ();">已发消息</a></li>
	            <li><a onclick="personal_recv_msg ();">已读消息</a></li>
	            <li><a onclick="personal_norecv_msg ();">未读消息</a></li>
	            <li><a onclick="personal_msg_create ();">发送消息</a></li>
	          </ul>
	        </li>
	        <li> <a class="nav-top-item">资源管理</a>
	          <ul>
	          	<li><a id="my_priv_src" onclick="personal_src_priv ();">私有资源</a></li>
	            <li><a id="my_sharing_src" onclick="personal_src_share ();">共享资源</a></li>
	            <li><a id="my_send_src" onclick="personal_src ();">发布资源</a></li>
	          </ul>
	        </li>
	        <li> <a class="nav-top-item">个人管理</a>
	          <ul>
	            <li><a id="my_info" onclick="personal_info ();">个人信息</a></li>
	            <li><a id="my_code" onclick="personal_code ();">密码管理</a></li>
	          </ul>
	        </li>
	        <li> <a href="#" class="nav-top-item">关于</a>
	          <ul>
	            <li><a href="#">使用规则</a></li>
	            <li><a href="#">开发者</a></li>
	            <li><a href="#">本系统</a></li>
	          </ul>
	        </li>
	      </ul>
    		</div>
  		</div>
		</div>
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
			<div id="content">
				<!--personal_info-->
				<div class="personal_outer outer">
					<div class="header-main">
						<div class="top">
							<div class="title-section item">
								<span class="name"></span>
								<a class="edit-button">
									<i class="icon icon-edu-button"></i>
									<span class="edit-msg" id="edit-name">修改姓名</span>
								</a>
								<a class="edit-input">
									<input type="text" maxlength="10" name="rname" id="txt_realname"/>
									<input type="button" id="btn_submit_name" 
										value="确定" />
									<input type="button" id="btn_cancel_name"
										value="取消" />
								</a>
							</div>
						</div>
						<div class="info-body">
							<div class="pic">
								<img class="headimg" alt="头像" src="/AthenaShare/src/Public/images/header.gif"/>
								<span class="edit-tip">修改头像</span>
								<span class="spinner"></span>
							</div>
							<div class="info">
								<div class="right-desc">
									<div class="items">
										<!--性别-->
										<div class="item">
											<i class="icon icon-location"></i>
											<span title="帐号" class="account"></span>
											<span class="gender">
												<i class="icon"></i>
											</span>
											<a class="edit-button">
												<i class="icon icon-edu-button"></i>
												<span class="edit-msg" id="edit-gend">修改性别</span>
											</a>
											<a class="edit-input">
												<input type="radio" name="gender" id="txt_male" value="1"/>男
												<input type="radio" name="gender" id="txt_female" value="0"/>女
												<input type="button" id="btn_submit_gender" 
													value="确定" />
												<input type="button" id="btn_cancel_gender" 
													value="取消" />
											</a>
										</div>
										<!--Email-->
										<div class="item">
											<i class="icon icon-email"></i>
											<span title="Email" class='email'></span>
											<a class="edit-button">
												<i class="icon icon-edu-button"></i>
												<span class="edit-msg" id="edit-email">修改Email</span>
											</a>
											<a class="edit-input">
												<input type="textbox" id="txt_email" />
												<input type="button" id="btn_submit_email" 
													value="确定" />
												<input type="button" id="btn_cancel_email" 
													value="取消" />
											</a>
										</div>
										<!--手机号-->
										<div class="item">
											<i class="icon icon-phone"></i>
											<span title="手机号" class="phone"></span>
											<a class="edit-button">
												<i class="icon icon-edu-button"></i>
												<span class="edit-msg" id="edit-phone">修改手机</span>
											</a>
											<a class="edit-input">
												<input type="textbox" id="txt_phone" />
												<input type="button" id="btn_submit_phone" 
													value="确定" />
												<input type="button" id="btn_cancel_phone" 
													value="取消" />
											</a>
										</div>
									</div>
									<div class="describe"></div>
								</div>
							</div>
						</div>
					</div>
				</div> 
				<!--personal_info-->
				<!--personal_msg_create-->
				<div class="content-box outer msg_create_outer">
				  <div class="content-box-header">
				    <h3>消息</h3>
				  </div>
				 	<div class="content-box-content">
				   	<div class="tab-content default-tab">
							<form>
				  			<fieldset>
				  				<p>
				  				  <label>发送消息到</label>
				  				  <input class="text-input small-input" type="text" 
				 					 	id="txt_rcver" name="kng_title" />
										<i></i>
				  				  <br />
				  				  <small><b>*</b>填写接收者帐号</small> 
				 					</p>
				  				<p>
				  				  <label>或者发送到:</label>
				  				  <input type="checkbox" id="admin" name="sharing" value="0" />
				  				  	所有管理员
				  				</p>
				  				<p>
				 					  <label>消息部分</label>
				  				   <textarea class="text-input textarea" 
											id="txt_msg" name="kng_desc" cols="79" 
				 					  	rows="15"></textarea>
				  				</p>
				  				<p>
										<i>还能输入<a id="char_len">300</a>字.</i>&nbsp;
				  				  <input id="submit_send_btn" class="button" 
											type="button" value="发射" onclick="send_msg ();" />
				  				</p>
				  			</fieldset>
				  			<div class="clear"></div>
							</form>
						</div>
					</div>
				</div>
				<!--personal_msg_create-->
				<!--personal_kng_new class="tab-content" id="tab2"-->
				<div class="content-box outer kng_new_outer">
				  <div class="content-box-header">
				    <h3>知识项</h3>
				  </div>
				 	<div class="content-box-content">
				   	<div class="tab-content default-tab" id="tab2">
							<form>
				  		<fieldset>
				  			<p>
				  			  <label>发布知识</label>
				  			  <input class="text-input small-input" type="text" 
				 				 	id="small-input" name="kng_title" />
			 				 	<select id="cate">
			 				 		<option value=0 selected="selected" class="display-none">请选择类别</option>
				 				 	<?php if(is_array($getCate)): foreach($getCate as $key=>$vo): ?><option value=<?php echo ($vo["id"]); ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
								</select>
				  			  <br />
				  			  <small>一个简单的标题</small> 
				 				</p>
				  			<p>
				  			  <label>愿与所有人分享吗？</label>
				  			  <input type="radio" id="sharing" name="sharing" value="0" checked="true" />
				  			  	与他人分享<br />
				  			  <input type="radio" name="sharing" value="1" />
				 				 	私人收藏
				  			</p>
				  			<p>
				 				  <label>主体部分</label>
				 				  <!--class="text-input textarea wysiwyg" -->
				  			   <textarea id="textfield" name="kng_desc" cols="79" 
				 				  	rows="15" width="1070px">
				 				  </textarea>
				 				  <script>
				 				  	CKEDITOR.replace ('textfield');
				 				  </script>
				  			</p>
				  			<p>
				  			  <input id="submit_btn" class="button" type="button" value="发射" />
				  			  <input id="submit_script_btn" class="button" type="button" value="保存" />
				  			</p>
				  		</fieldset>
				  		<div class="clear"></div>
							</form>
						</div>
					</div>
				</div>
				<!--personal_kng_new-->
				<!--personal_kng_mine-->
				<div class="content-box outer kng_outer src_outer msg_outer">
				  <div class="content-box-header">
				    <h3>内容</h3>
				    <ul class="content-box-tabs">
				      <li><a href="#tab1" class="default-tab eyebrow1"></a></li>
				      <!--<li><a href="#tab2">新编写</a></li>-->
				    </ul>
				    <div class="clear"></div>
				  </div>
				  <div class="content-box-content">
				    <div class="tab-content default-tab" id="tab1">
							<div class="notification information png_bg"> 
								<a href="#" class="close"><img src="/AthenaShare/src/Public/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				  			<div id="notify_info"> 
								</div>
							</div>
				      <table>
				        <thead id="thead">
				        </thead>
				        <tfoot>
				          <tr>
				            <td colspan="6">
				              <div class="pagination"> 
											</div>
				              <div class="clear"></div>
				            </td>
				          </tr>
				        </tfoot>
				        <tbody id="tbody">
				        </tbody>
				      </table>
				    </div>
				    
				  </div>
				</div>
				<div class="clear"></div>
				<!--Message box-->
				<div id="msgbox" style="display:none;">
					<div class="popup">
						<div style="display: block;" class="content">
							<div id="msg" style="display: block;">
								<p class="msg-box-info">
									时间:<i></i>&nbsp;&nbsp;&nbsp;&nbsp;
									发送者:<a></a>
								</p>
								<p class="msg-box-body">
								</p>
							</div>
						</div>
						<div style="display: block;" class="footer">
							<a href="#">
								<img src="/AthenaShare/src/Public/images/close_2.png" style="width:20px;" onclick="close_msg ();"/>
							</a>
						</div>
					</div>
				</div>
				<!--Message box-->
				<!--personal_kng_mine-->
				<!--Resource box-->
				<div id="srcbox" style="display:none;">
					<div class="popup">
						<div style="display: block;" class="content">
							<div id="src" style="display: block;">
								<p class="msg-box-title">
									<b></b>
								</p>
								<p class="msg-box-info">
									时间:<i></i>&nbsp;&nbsp;&nbsp;&nbsp;
									作者:<a class="r"></a>&nbsp;&nbsp;&nbsp;&nbsp;
									下载次数:<b></b>&nbsp;&nbsp;&nbsp;&nbsp;
									<a class="d" target="_blank">下载</a>
								</p>
								<p class="msg-box-body">
								</p>
							</div>
						</div>
						<div style="display: block;" class="footer">
							<a>
								<img src="/AthenaShare/src/Public/images/close_2.png" style="width:20px;" onclick="close_src ();"/>
							</a>
						</div>
					</div>
				</div>
				<!--Resource box-->
				<!--personal_src-->
				<div class="content-box outer src_new_outer">
				  <div class="content-box-header">
				    <h3>知识项</h3>
				  </div>
				 	<div class="content-box-content">
 					<!--id="tab2"-->
						<div class="tab-content default-tab">
							<form method='post' action='/AthenaShare/src/index.php/Src/upload_src'  enctype="multipart/form-data">
							  <fieldset>
							    <p>
							      <label>上传资源</label>
						        <input type="text" name="src_name"/>
						        <input type="file" class="button" id="filesrc" name="src_file"/>
							      <br />
							      <small>为你的文件起个名字吧</small> 
								  </p>
						        <p>
						          <label>愿与所有人分享吗？</label>
						          <input type="radio" name="src_sharing" id="src_sharing" value="1"/>
						          	与他人分享<br />
						          <input type="radio" name="src_sharing" id="src_private" checked="checked" value="0" />
												私人收藏
						        </p>
						        <p>
											<label>主体部分</label>
						          <textarea class="text-input textarea" id="txt_srcdesc" name="src_desc" cols="79" rows="15"></textarea>
						        </p>
						        <p>
						          <input class="button" type="submit" id="submit_send_src"  value="发射" />
						        </p>
							  </fieldset>
							  <div class="clear"></div>
							  <!-- End .clear -->
							</form>
						</div>
					</div>
				</div>
				<!--personal_src-->
				<!--personal_code-->
				<div class="outer code-outer">
					<p>请输入您的旧密码和新密码</p>
					<div><input type='password' placeholder="请输入旧密码"
						id='p1' size='20' name='old_passcode'/><span><i>*</i></span></div>
					<div><input type='password' placeholder="新密码"
						id='p2' size='20' name='new_passcode'/><span><i>*</i></span></div>
					<div><input type='password' placeholder="确认密码"
						id='p3' size='20'name="confirm_passcode"/><span><i>*</i></span></div>
					<div><input type='button' id="code_submit" value='提交'/><span><i>*</i></span></div>
				</div>
				<!--personal_code-->
			</div>
			<!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
    	<div id="footer"> 
				<small>&#169; Copyright 2016 xxx Company | Powered by 
					<a href="http://dreamtech.club">NCEPU Dre@mtech</a> | 
					<a href="#">Top</a> 
				</small> 
			</div>
		</div>
	</body>
</html>