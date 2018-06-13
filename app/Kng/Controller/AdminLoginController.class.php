<?php

/*
 * Author : JasonLin
 * Describe : admin.
 * Date : 2016/5/31
 */
namespace Kng\Controller;
use think\Controller;
class AdminLoginController extends Controller {
    //管理员登录
    public function login(){
        $this->display();
    }

    //管理员登录检查
    public function checklog(){
       $usr= I('post.usr');
       $pwd= md5(I('post.pwd'));
       $result = M('admin')->where("admin_account='%s' AND admin_passcode='%s'",$usr,$pwd)->find();
       if($result){
            $_SESSION['admin_id'] = $result['admin_id'];
			$this -> redirect ('Admin/index');
       }else{
            $this->error('登陆失败');
       }
    }

    //管理员退出
    public function logout(){
        session(null);
		$this -> redirect ('AdminLogin/login'); // JasonLin 2018/5/213
    }
}
