<?php
namespace Kng\Controller;
use Kng\Controller\BaseController;

class UserController extends BaseController{

	    public function info(){
            $this -> usr_name = $_SESSION ['usr_name'];
            $this -> kng_tab = -1;
            $this -> msg_tab = -1;
            $this->display();
        }
		public function get_info () {
			$usr_id = $_SESSION ['usr_id'];
			$usr = M('usr');
			$data = $usr -> find ($usr_id);
			$rtn ['name'] = $data ['usr_real_name'];
			$rtn ['gender'] = $data ['usr_gender'];
			$rtn ['account'] = $data ['usr_account'];
			$rtn ['email'] = $data ['usr_email'];
			$rtn ['phone'] = $data ['usr_phone_num'];
			$datas = json_encode($rtn);
            $this -> ajaxReturn($datas);
		}

		public function edit_info() {
			$usr_id = $_SESSION ['usr_id'];
			$new_name = $_POST['name'];
			$new_gender = $_POST['gender'];
			$new_email = $_POST['email'];
			$new_phone_num = $_POST['phone'];

			$usr = M('usr');
			$new_data['usr_real_name'] = $new_name;
			$new_data['usr_gender'] = $new_gender;
			$new_data['usr_email'] = $new_email;
			$new_data['usr_phone_num'] = $new_phone_num;
			$result = $usr -> where ("usr_id=$usr_id") -> save($new_data);
			if ($result > 0){
                $_SESSION ['usr_name'] = $new_name;
                $arr = array('code' => 0,'msg'=>'修改成功');
            }else{
                $arr = array('code' => 1,'msg'=>'未修改');
            }
            print_r(json_encode($arr));
		}


		public function send_email() {
			$account = $_POST['usr_account'];
			$email = $_POST['usr_email'];
			$usr = M('usr');
			$data = $usr -> where("usr_account = '$account'") -> find();
			if($data == null){
				$this -> error("用户名不存在！");
			}else{
				if($data['usr_email'] == null ){
					$this -> error("对不起，您没有预留邮箱！");
				}else if($data['usr_email'] != $email){
					$this -> error("对不起，您输入的邮箱不是该账户的预留邮箱！");
				}
			}
			$name = $data['usr_real_name'];
			$time = date('Y-m-d H:i:s');
			$subject = "EZSYS密码找回";
			$captcha = GetRandNum(6);
			$body = "<p>尊敬的{$name}，您好。<br/>    您于{$time}使用找回密码功能，我们将您的密码重置为<i>{$captcha}</i>，请您及时登录AthenaShare进行修改密码操作。</p>";
			//echo "<script>alert('$name');</script>";

			if(ezsys_send_mail($email,$name,$subject,$body,null)){

				$new_data['usr_passcode']=md5($captcha);
				$result = M('usr') -> where("usr_account='$account'") -> save($new_data);
				$this -> success("邮件发送成功！");
			}else{
				$this -> error("邮件发送失败！");
			}
		}
}
