<?php if (!defined('THINK_PATH')) exit();?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>管理员中心</title>
    <link rel="shortcut icon" href="/EZSYS/src/Public/images/favicon.ico" />
    <!--<link rel="stylesheet" type="text/css" href="/EZSYS/src/Public/css/admin_common.css"/>-->
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
            <div class="crumb-list"><i class="icon-font"></i><a href="main.html">EZSYS管理</a><span class="crumb-step">&gt;</span><span class="crumb-name">知识管理</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="/EZSYS/src/index.php/admin/admin_kng" id='form1' method='get'>
                    <table class="search-tab">
                        <tr>
                            <th width="120">选择分类:</th>
                            <td>
                                <select name="cateId" onchange="submit()">
                                    <option value=-1>全部</option>
                                    <?php if(is_array($cate)): foreach($cate as $key=>$vo): if($vo["id"] == $selectCate): ?><option value=<?php echo ($vo["id"]); ?> selected="selected"><?php echo ($vo["name"]); ?></option>
                                        <?php else: ?>
                                           <option value=<?php echo ($vo["id"]); ?>><?php echo ($vo["name"]); ?></option><?php endif; endforeach; endif; ?>
                                </select>
                            </td>
                            <th width="70"><a href="#" id="add">添加分类</a></th>
                            <th width="70">搜索:</th>
                            <td><input type="text" class="common-text" placeholder="请输入知识名关键字" name="keywords" value="<?php echo ($keys); ?>" id=""></td>
                            <td><input type="submit" class="btn btn-primary btn2"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="result-wrap">
            <form action="/EZSYS/src/index.php/admin/delete_kng" name="myform" id="myform" method="post">
                <div class="result-title">
                    <div class="result-list">
                        <a id="batchDel" onclick="myform.submit()"><i class="icon-font"></i>批量删除</a>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="5%"></th>
                            <th class='kName'>知识名称</th>
                            <th>所属类别</th>
                            <th>作者</th>
                            <th>发布时间</th>
                            <th>热度</th>
                        </tr>
                        <?php if(is_array($kng_data)): foreach($kng_data as $key=>$vo): ?><tr>
                            <td class="tc"><input type="checkbox" name="id[]" value=<?php echo ($vo["id"]); ?>></td>
                            <td class='kName'><a href="#"><?php echo ($vo["name"]); ?></a></td>
                            <td><?php echo ($vo["cate"]); ?></td>
                            <td><?php echo ($vo["owner"]); ?></td>
                            <td><?php echo ($vo["date"]); ?></td>
                            <td><?php echo ($vo["hot"]); ?></td>
                        </tr><?php endforeach; endif; ?>
                    </table>
                    <div class="list-page"> 
                    <?php echo ($page); ?>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <!--/main-->
</div>

<div id="addBox">
<form method = 'post' action ='/EZSYS/src/index.php/Admin/add_cate'>
    <div class="row1">
        添加分类<a href="javascript:void(0)" title="关闭窗口" class="close_btn" id="closeBtn">×</a>
    </div>
    <div class="row">
         分类名 <span class="inputBox">
            <input type="text" id="txtName" name='cateName' placeholder="请输入分类名" />
            </span>
    </div>
    <div class="row">
        <input id="addbtn" type="submit" value="添加"/></a>
    </div>
</form>
</div>

</body>
</html>