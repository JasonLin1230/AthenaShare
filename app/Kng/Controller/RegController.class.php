<?php
namespace Kng\Controller;
use Think\Controller;

class RegController extends Controller {
	public function index(){
		$this -> display ();
  }

  public function reg(){
      $username=$_POST['username'];
      $data ['usr_passcode']=md5($_POST['password']);
      $data ['usr_email'] = $_POST ['email'];
      $data ['usr_account'] = $username;
      $data ['usr_real_name'] = $username;
      $m = M("usr");
      $isreg = M("usr") -> where("usr_account = '$username'") -> find();
      if($isreg){
          $arr = array('code' => 1,'msg'=>'该用户名已被占用！');
      }else{
          $msg=$m->create($data);
          $result = $m -> add();
          if($result){
             $arr = array('code' => 0,'msg'=>'注册成功！');
          }else{
             $arr = array('code' => 1,'msg'=>'系统错误！');
          }
    }
    print_r(json_encode($arr));
  }
}
