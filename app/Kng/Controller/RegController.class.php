<?php
namespace Kng\Controller;
use Think\Controller;

class RegController extends Controller {

	public function reg(){
		$this -> display ();
  }

    public function valid_email() {
        $email = $_POST['email'];
        $name = "新用户";
        $time = date('Y-m-d H:i:s');
        $subject = "AthenaShare邮箱验证";
        $captcha = GetRandNum(6);
        $body = "<p>【AthenaShare】欢迎注册AthenaShare系统，您的邮箱验证码是<i>{$captcha}</i>，5分钟内有效。如非本人操作，请您忽略本短信。</p>";
        if(ezsys_send_mail($email,$name,$subject,$body,null)){
            $new_data['usr_passcode']=md5($captcha);
            $arr = array('code' => 0,'msg'=>'邮件发送成功！');
        }else{
            $arr = array('code' => 1,'msg'=>'邮件发送失败！');
        }
        print_r(json_encode($arr));
    }

  public function reg_usr(){
      $username=$_POST['username'];
      if($username == null){//验证邮箱
          $email = $_POST['email'];
          $name = "新用户";
          $subject = "AthenaShare邮箱验证";
          $captcha = GetRandNum(6);
          $_SESSION['valid_email'] = $captcha;
          session_set_cookie_params('300');//设置这个session生存期5分钟
          ini_set('session.gc_maxlifetime','300');
          $body = "<p>【AthenaShare】欢迎注册AthenaShare系统，您的邮箱验证码是<i>{$captcha}</i>，5分钟内有效。如非本人操作，请您忽略本短信。</p>";
          if(ezsys_send_mail($email,$name,$subject,$body,null)){
              $new_data['usr_passcode']=md5($captcha);
              $arr = array('code' => 0,'msg'=>'邮件发送成功！');
          }else{
              $arr = array('code' => 1,'msg'=>'邮件发送失败！');
          }
          print_r(json_encode($arr));
      }else{//注册
          $valid_email= $_POST ['valid_email'];
          if(!$_SESSION['valid_email']){
              $arr = array('code' => 1,'msg'=>'邮箱验证验证超时！');
          }else{$data ['usr_passcode']=md5($_POST['password']);
              $data ['usr_email'] = $_POST ['email'];
              $data ['usr_account'] = $username;
              $data ['usr_real_name'] = $username;
              $m = M("usr");
              if($valid_email != $_SESSION['valid_email']){
                  $arr = array('code' => 1,'msg'=>'邮箱验证码错误！');
              }else{
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
              }
          }
          print_r(json_encode($arr));
      }
  }
}
