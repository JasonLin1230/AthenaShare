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
       $has_usr = M('usr')->where("usr_account='%s'",$usr)->find();
       $result = M('usr')->where("usr_account='%s' AND usr_passcode='%s'",$usr,$pwd)->find();
       if(!$has_usr){
           $arr = array('code' => 1,'msg'=>'用户不存在');
           print_r(json_encode($arr));
       }else if (!$result){
           $arr = array('code' => 1,'msg'=>'密码错误');
           print_r(json_encode($arr));
       }else{
            $_SESSION['usr_id'] = $result['usr_id'];
            $_SESSION ['usr_name'] = $result ['usr_real_name'];
            $this -> redirect ('Main/index'); // ez 2016/5/23
       }
    }
    public  function logout(){
        session(null);
		$this -> redirect ('Login/index'); // ez 2016/5/13
    }

}
