<?php if (!defined('THINK_PATH')) exit();?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>管理员中心</title>
	<link rel="shortcut icon" href="/EZSYS/src/Public/images/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="/EZSYS/src/Public/css/admin_common.css"/>
    <link rel="stylesheet" type="text/css" href="/EZSYS/src/Public/css/admin_main.css"/>
    <script type="text/javascript" src="/EZSYS/src/Public/scripts/jquery-1.12.3.min.js"></script>
    <script type="text/javascript" src="/EZSYS/src/Public/scripts/admin.js"></script>
</head>
<body>
<div class="topbar-wrap white">
    <div class="topbar-inner clearfix">
    </div>
</div>
<div class="container clearfix">
    <div class="sidebar-wrap">
        <div class="sidebar-title">
            <h1>菜单</h1>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>EZSYS管理</a>
                    <ul class="sub-menu">        
                        <li><a href="/EZSYS/src/index.php/admin/main"><i class="icon-font">&#xe017;</i>管理中心</a></li>
                        <li><a href="/EZSYS/src/index.php/admin/admin_usr"><i class="icon-font">&#xe003;</i>用户管理</a></li>
                        <li><a href="/EZSYS/src/index.php/admin/admin_kng"><i class="icon-font">&#xe006;</i>知识管理</a></li>
                        <li><a href="/EZSYS/src/index.php/admin/admin_src"><i class="icon-font">&#xe005;</i>资源管理</a></li>
						<li><a href="/EZSYS/src/index.php/admin/logout"><i class="icon-font">&#xe020;</i>退出</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--/sidebar-->
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="main.html">EZSYS管理</a><span class="crumb-step">&gt;</span><span class="crumb-name">管理中心</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <table class="insert-tab" width="100%">
                    <tbody><tr>
                        <th width="120"><i class="require-red">*</i>管理员人数：</th>
                        <td><?php echo ($adm_count); ?>&nbsp;&nbsp;（<a href="#" id="add">添加</a>）</td>
                    </tr>
                        <tr>
                            <th><i class="require-red">*</i>用户人数：</th>
                            <td><a href="admin_usr.html"><?php echo ($usr_count); ?></a></td>
                        </tr>
                        <tr>
                            <th><i class="require-red">*</i>知识项总数：</th>
                            <td><a href="admin_kng.html"><?php echo ($kng_count); ?></a></td>
                        </tr>
                        <tr>
                            <th><i class="require-red">*</i>资源总数：</th>
                            <td><a href="admin_src.html"><?php echo ($src_count); ?></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!--/main-->
</div>

<div id="addBox">
<form method = 'post' action ='/EZSYS/src/index.php/Admin/add_admin'>
    <div class="row1">
        新增管理员<a href="javascript:void(0)" title="关闭窗口" class="close_btn" id="closeBtn">×</a>
    </div>
    <div class="row">
        账号 <span class="inputBox">
            <input type="text" id="txtName" name='admin_account' placeholder="请输入您的账号" />
            </span><i id='acc_warn'></i>
    </div>
    <div class="row">
        密码 <span class="inputBox">
            <input type="password" id="txtEmail" name='admin_pass' placeholder="请输入您的密码" />
            </span><i id='ema_warn'></i>
    </div>
    <div class="row">
        <input id="addbtn" type="submit" value="添加"/></a>
    </div>
</form>
</div>

</body>
</html>