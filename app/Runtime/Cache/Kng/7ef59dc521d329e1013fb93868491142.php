<?php if (!defined('THINK_PATH')) exit();?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>管理员中心</title>
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
            <div class="crumb-list"><i class="icon-font"></i><a href="main.html">EZSYS管理</a><span class="crumb-step">&gt;</span><span class="crumb-name">用户管理</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th>用户名</th>
                            <th>真实姓名</th>
                            <th>邮箱</th>
                            <th>知识项数</th>
                            <th>资源数</th>
                            <th>操作</th>
                        </tr>
                        <?php if(is_array($usr_data)): foreach($usr_data as $key=>$vo): ?><tr>
                            <td><?php echo ($vo["name"]); ?></td> 
                            <td><?php echo ($vo["real_name"]); ?></td>
                            <td><?php echo ($vo["email"]); ?></td>  
                            <td><?php echo ($vo["personal_kng_count"]); ?></td>
                            <td><?php echo ($vo["personal_src_count"]); ?></td>
                            <td>
                                <a class="link-del" href="#">屏蔽</a>
                            </td>
                        </tr><?php endforeach; endif; ?>
                    </table>
                    <div class="list-page"> 
                    <?php echo ($page); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--/main-->
</div>
</body>
</html>