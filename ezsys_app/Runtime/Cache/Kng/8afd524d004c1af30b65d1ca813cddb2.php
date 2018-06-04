<?php if (!defined('THINK_PATH')) exit();?><div class="outer">
	<div class="header-main">
		<div class="top">
			<div class="title-section">
				<span class="name"><?php echo ($real_name); ?></span>
				<span class="bio" title=""></span>
			</div>
		</div>
		<div class="info-body">
			<div class="pic">
				<img class="headimg" alt="头像"/>
				<span class="edit-tip">修改头像</span>
				<span class="spinner"></span>
			</div>
			<div class="info">
				<div class="right-desc">
					<div class="items">
						<!--居住地-->
						<div class="item">
							<i class="icon icon-location"></i>
							<span class="info-wrap">
								<span title="帐号"><?php echo ($account); ?></span>
								<span class="gender"><i class="icon icon-male"></i>
								</span>
								<a class="edu-button">
									<i class="icon icon-edu-button"></i>
									<span class="edit-msg">修改</span>
								</a>
							</span>
						</div>
						<!--公司信息-->
						<div class="item">
							<i class="icon icon-email"></i>
							<span title="Email"><?php echo ($email); ?></span>
							<a class="email-button">
									<i class="icon icon-edu-button"></i>
									<span class="edit-msg">修改</span>
								</a>
						</div>
						<div class="item">
							<i class="icon icon-phone"></i>
							<span title="手机号" class="business"><?php echo ($phone_num); ?></span>
							<a class="phone-button">
								<i class="icon icon-edu-button"></i>
								<span class="edit-msg">修改</span>
							</a>
						</div>
					</div>
					<div class="describe"></div>
				</div>
			</div>
		</div>
	</div>
</div>