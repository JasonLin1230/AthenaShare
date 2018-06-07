<?php if (!defined('THINK_PATH')) exit();?><div class="content-box">
	<script type="text/javascript">
	  function del_src (url) {
	    if (true == confirm ('您确定要删除吗？此操作将删除其下所有的评论，回复')) {
				$.get (url, function (data) { alert ('已删除成功!'); });
	    } 
	  }
		// Content box tabs:
		// Hide the content divs
		$('.content-box .content-box-content div.tab-content').hide(); 
		// Add the class "current" to the default tab
		$('ul.content-box-tabs li a.default-tab').addClass('current'); 
		// Show the div with class "default-tab"
		$('.content-box-content div.default-tab').show(); 
		// When a tab is clicked...
		$('.content-box ul.content-box-tabs li a').click( 
			function() { 
				// Remove "current" class from all tabs
				$(this).parent().siblings().find("a").removeClass('current'); 
				// Add class "current" to clicked tab
				$(this).addClass('current'); 
				// Set variable "currentTab" to the value of href of clicked tab
				var currentTab = $(this).attr('href'); 
				// Hide all content divs
				$(currentTab).siblings().hide(); 
				// Show the content div with the 
				// id equal to the id of clicked tab
				$(currentTab).show(); 
				return false; 
			}
		);

    //Close button:
		$(".close").click(
			function () {
				$(this).parent().fadeTo(400, 0, function () { // Links with the class "close" will close parent
					$(this).slideUp(400);
				});
				return false;
			}
		);

    // Alternating table rows:
		$('tbody tr:even').addClass("alt-row"); // Add class "alt-row" to even table rows

	  $("a[rel*=facebox]").each (function () {
	          $(this).click (function () {
	              var id = $(this).attr ('ez');
	              htmlobj = $.ajax ({
	                  url: "/index.php/index/get_src?kid=" + id, 
	                  async: false
	          })
	          $.facebox (htmlobj.responseText);
	      });
	  });
 // href="/index.php/index/personal_src_private"
	</script>
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
	          <th>下载次数</th>
	          <th>操作</th>
	        </tr>
	      </thead>
	      <tfoot>
	        <tr>
	          <td colspan="6">
	              <div class="pagination"> 
					<a href="/index.php/index/personal_src_private?pga=0" title="First Page">&laquo;首页</a>
					<a href="/index.php/index/personal_src_private?pga=<?php echo ($former_page); ?>" title="Previous Page">&laquo;上一页</a> 
					<?php if(is_array($page_list)): $i = 0; $__LIST__ = $page_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><a href="/index.php/index/personal_src_private?pga=<?php echo ($p); ?>" class="number" title="<?php echo ($p); ?>"><?php echo ($p+1); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
					<a href="/index.php/index/personal_src_private?pga=<?php echo ($next_page); ?>" title="Next Page">下一页&raquo;</a>
					<a href="/index.php/index/personal_src_private?pga=<?php echo ($last_page); ?>" title="Last Page">尾页&raquo;</a> 
			    </div>
	            <div class="clear"></div>
	          </td>
	        </tr>
	      </tfoot>
	      <tbody>
					<?php if(is_array($src_list)): $i = 0; $__LIST__ = $src_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$k): $mod = ($i % 2 );++$i;?><tr>
	          <td><a rel="facebox" ez="<?php echo ($k["src_id"]); ?>" title="<?php echo ($k["src_name"]); ?>"><?php echo ($k["src_id"]); ?>.<?php echo (mb_substr($k["src_name"],0,20)); ?>...
							</a>
						</td>
	          <td><a title="发布时间"><?php echo ($k["src_update_date"]); ?>
							</a>
						</td>
	          <td>
                  <a><?php echo ($k["src_down_times"]); ?></a>
              </td>
	          <td>
              <a title="Delete" href="#">
                <img src="/Public/images/icons/cross.png" onclick="del_src ('/index.php/index/delete_src?kid=<?php echo ($k["src_id"]); ?>');"
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