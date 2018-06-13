<?php
/**
 * Created by PhpStorm.
 * User: JasonLin
 * Date: 2018/6/13
 * Time: 20:06
 */

namespace Kng\Controller;
use think\Controller;

// 指定允许其他域名访问
header('Access-Control-Allow-Origin:*');
// 响应类型
header('Access-Control-Allow-Methods:*');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');

class AdminBaseController extends Controller
{
    //初始化方法
    public function _initialize(){
        if(!$_SESSION ['admin_id']){
            $this->redirect('AdminLogin/login');
        }
    }
}