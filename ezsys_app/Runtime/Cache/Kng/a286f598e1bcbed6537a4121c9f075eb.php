<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
	<script type="text/javascript">
		
	</script>
</head>
<body>
<div class="content-box">
	
	  <!-- Start Content Box -->
	<div class="content-box-header">
	  <h3>消息</h3>
	  <ul class="content-box-tabs">
	    <li><a href="#tab1" class="default-tab"><?php echo ($menu); ?>消息</a></li>
	    <li><a href="#tab2">上传</a></li>
	  </ul>
	  <div class="clear"></div>
	</div>
	<!-- End .content-box-header -->
	<div class="content-box-content">
	  <div class="tab-content default-tab" id="tab1">
	    <!-- This is the target div. id must match the href of this div's tab -->
			<div class="notification information png_bg"> 
				<a href="#" class="close"><img msg="/Public/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div> 
					<?php if(($num > 0)): ?>这是您目前上传的消息, 按时间排序, 当前在<b>第<?php echo ($current_page+1); ?>页</b>.
					<?php else: ?>
						您目前还没有上传任何呢 :(<?php endif; ?>
				</div>
			</div>
	    <table>
	      <thead>
	        <tr>
	          <th>标题</th>
	          <th>时间</th>
	          <th>下载次数</th>
	          <th>操作</th>
	        </tr>
	      </thead>
	      <tfoot>
	        <tr>
	          <td colspan="6">
	              <div class="pagination"> 
					<a href="/index.php/index/personal_msg_private?pga=0" title="First Page">&laquo;首页</a>
					<a href="/index.php/index/personal_msg_private?pga=<?php echo ($former_page); ?>" title="Previous Page">&laquo;上一页</a> 
					<?php if(is_array($page_list)): $i = 0; $__LIST__ = $page_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><a href="/index.php/index/personal_msg_private?pga=<?php echo ($p); ?>" class="number" title="<?php echo ($p); ?>"><?php echo ($p+1); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
					<a href="/index.php/index/personal_msg_private?pga=<?php echo ($next_page); ?>" title="Next Page">下一页&raquo;</a>
					<a href="/index.php/index/personal_msg_private?pga=<?php echo ($last_page); ?>" title="Last Page">尾页&raquo;</a> 
			    </div>
	            <div class="clear"></div>
	          </td>
	        </tr>
	      </tfoot>
	      <tbody>
					<?php if(is_array($msg_list)): $i = 0; $__LIST__ = $msg_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$k): $mod = ($i % 2 );++$i;?><tr>
	          <td><a rel="facebox" ez="<?php echo ($k["msg_id"]); ?>" title="<?php echo ($k["msg_name"]); ?>"><?php echo ($k["msg_id"]); ?>.<?php echo (mb_substr($k["msg_name"],0,20)); ?>...
							</a>
						</td>
	          <td><a title="发布时间"><?php echo ($k["msg_update_date"]); ?>
							</a>
						</td>
	          <td>
                  <a><?php echo ($k["msg_down_times"]); ?></a>
              </td>
	          <td>
              <a title="Delete" href="#">
                <img msg="/Public/images/icons/cross.png" onclick="del_msg ('/index.php/index/delete_msg?kid=<?php echo ($k["msg_id"]); ?>');"
						alt="删除" />
               </a>
               <a href="#" title="分享">
								<img msg="/Public/images/icons/hammer_screwdriver.png" 
						alt="分享" />
               </a>
						</td>
	        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
	      </tbody>
	    </table>
	  </div>
	  <!-- End #tab1 -->
	  <div class="tab-content" id="tab2">
	    <form action="/index.php/message/msg_send_utou" enctype="multipart/form-data" method="post">
	      <fieldset>
	      <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
	      <p>
	        <label>上传消息</label>
          	收件人：<select name="">
						<option value="用户">用户
						<option value="管理员">管理员</option>
					</select>
						</option><input type="text" name="reciver" />
              
				</p>
  	        <p>
							<label>主体部分</label>
  	          <textarea class="text-input textarea wysiwyg" id="textfield" name="describe" cols="79" rows="15"></textarea>
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
</body>
</html>