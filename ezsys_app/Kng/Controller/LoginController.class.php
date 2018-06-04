<?php
namespace Kng\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
        $this->display();
    }

    public function checklog(){
       $usr= I('post.usr');
       $pwd= md5(I('post.pwd'));
       $result = M('usr')->where("usr_account='%s' AND usr_passcode='%s'",$usr,$pwd)->find();
       if($result){
            $_SESSION['usr_id'] = $result['usr_id'];
            $_SESSION ['usr_name'] = $result ['usr_real_name']; // ez 2016/5/6
            // $this->success('登陆成功', U ('index/index')); // ez 2016/5/6
            $this -> redirect ('Main/index'); // ez 2016/5/23
       }else{
            $this->error('登陆失败');
       }
    }


    public  function logout(){
        session(null);
        // $this->success('欢迎再来!',U('Login/index'),3);
				$this -> redirect ('Login/index'); // ez 2016/5/13
    }

}
