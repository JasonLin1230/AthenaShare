<?php
/**
 * Created by PhpStorm.
 * User: JasonLin
 * Date: 2018/6/4
 * Time: 7:31
 */
namespace Kng\Controller;
use think\Controller;

// 指定允许其他域名访问
header('Access-Control-Allow-Origin:*');
// 响应类型
header('Access-Control-Allow-Methods:*');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');

class BaseController extends Controller
{
    //初始化方法
    public function _initialize(){
        if(!$_SESSION ['usr_id']){
            $this->redirect('Login/index');
            // $this->error("请先登录系统！",'Login/index');
        }
    }
}