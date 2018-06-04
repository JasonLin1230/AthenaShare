<?php
namespace Kng\Controller;
use Think\Controller;

class RegController extends Controller {
	public function index(){
		$this -> display ('signup');
  }

	// ez 2016/5/25 
  public function reg(){
  	$data ['usr_account']=$_POST['usr'];
  	$data ['usr_passcode']=md5($_POST['pwd']);
  	// $data['usr_real_name']=$_POST['realname'];
		$data ['usr_email'] = $_POST ['mail'];
		$data ['usr_real_name'] = $_POST ['usr'];
  	// $data ['usr_gender']=$_POST['sex'];
  	$m=M("usr");
  	$msg=$m->create($data);
  	$result=$m -> add();
		$this -> ajaxReturn ($result);
  	// if($result==true){
  	// 	// setcookie("username",$data['usr']);
  	// 	// $this->success("注册成功",U('Login/index'));
  	// }else{
  	// 	$this->error("注册失败，用户名已经被占用");
  	// }
  }


  //判断用户名是否存在  zzk 2016/5/31
  public function checkreg(){
    $account = $_POST['usr'];
    $data = M("usr") -> where("usr_account = '$account'") -> find();
    if($data != null){
      $rtn = -1;
    }else{
      $rtn = 1;
    }
    $this -> ajaxReturn ($rtn);
  }

}
