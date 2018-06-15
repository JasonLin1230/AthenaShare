<?php
namespace Kng\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function login(){
        $this->display();
    }

    public function checklog(){
       $usr= I('post.username');
       $pwd= md5(I('post.password'));
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
            session_set_cookie_params('1800');//设置session生存期30分钟
            ini_set('session.gc_maxlifetime','1800');
            $arr = array('code' => 0,'msg'=>'登陆成功');
            print_r(json_encode($arr));
       }
    }
    public  function logout(){
        session(null);
		$this -> redirect ('Login/login'); // JasonLin 2018/6/3
    }
    public function send_email() {
        $account = $_POST['usr_account'];
        $email = $_POST['usr_email'];
        $usr = M('usr');
        $data = $usr -> where("usr_account = '$account'") -> find();
        if($data == null){
            $arr = array('code' => 1,'msg'=>'用户不存在');
        }else{
            if($data['usr_email'] == null ){
                $arr = array('code' => 1,'msg'=>'您没有预留邮箱！');
            }else if($data['usr_email'] != $email){
                $arr = array('code' => 1,'msg'=>'您输入的邮箱不是该账户的预留邮箱！');
            }else{
                $name = $data['usr_real_name'];
                $time = date('Y-m-d H:i:s');
                $subject = "AthenaShare密码找回";
                $captcha = GetRandNum(6);
                $body = "<p>尊敬的{$name}，您好。<br/>    您于{$time}使用找回密码功能，我们将您的密码重置为<i>{$captcha}</i>，请您及时登录AthenaShare进行修改密码操作。</p>";

                if(ezsys_send_mail($email,$name,$subject,$body,null)){
                    $new_data['usr_passcode']=md5($captcha);
                    M('usr') -> where("usr_account='$account'") -> save($new_data);
                    $arr = array('code' => 0,'msg'=>'邮件发送成功！');
                }else{
                    $arr = array('code' => 1,'msg'=>'邮件发送失败！');
                }
            }
        }
        print_r(json_encode($arr));
    }
}
