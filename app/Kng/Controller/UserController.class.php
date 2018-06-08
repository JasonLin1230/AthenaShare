<?php
namespace Kng\Controller;
use Kng\Controller\BaseController;

class UserController extends BaseController{
	    /*
		 * Author : JasonLin
		 * Describe : 个人信息管理。
		*/
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

		/*
		 * Author : JasonLin
		 * Describe : 个人信息编辑。
		*/
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


		/*
		 * Author : zzk
		 * Describe : 修改密码。
		*/
		public function reset_passcode() {
			// ez 2016/5/14
			// $usr_id = $_SESSION ['usr_id'];
			if(($usr_id = check_login ()) < 0)
				$this -> redirect('Login/index'); 

			$passcode = md5 ($_POST ['passcode']);
			$new_passcode = md5 ($_POST ['new_passcode']);

			$usr = M ('usr');
			$data = $usr -> find ($usr_id);
			if($passcode != $data ['usr_passcode']) {
				// error ('原密码输入有误！');
				$this -> ajaxReturn (-1); // former code error.
			} else {
				$new_data ['usr_passcode'] = $new_passcode;
			}
			$rtn = $usr -> where ("usr_id=$usr_id") -> save ($new_data);
			if ($rtn != 1){
				$rtn = -1;
			} else {   //如果原密码和新密码一样，
				session(null);
				$rtn = 1;
			}
			$this -> ajaxReturn ($rtn);
		}


		/*
		 * Author : zzk
		 * Describe : 找回密码。
		 */
		public function forget_passcode() {
			$this -> display ();
		}




		/*
		 * Author : zzk
		 * Describe : 发送验证码到邮件。
		 */
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
			$body = "<p>尊敬的{$name}，您好。<br/>    您于{$time}使用找回密码功能，我们将您的密码重置为<i>{$captcha}</i>，请您及时登录EZSYS进行修改密码操作。</p>";
			//echo "<script>alert('$name');</script>";

			if(ezsys_send_mail($email,$name,$subject,$body,null)){

				$new_data['usr_passcode']=md5($captcha);
				$result = M('usr') -> where("usr_account='$account'") -> save($new_data);
				$this -> success("邮件发送成功！");
			}else{
				$this -> error("邮件发送失败！");
			}
		}



		/*
		 * Author : zzk
		 * Describe : 找回密码响应，判断用户名是否存在。
		 */
	    public function is_account(){ //account是否存在
	    	$account = I('get.account');
	    	$rtn = M('usr') -> where("usr_account = '$account'") -> field('usr_id') -> find();
			if($rtn == null){
				$this -> ajaxReturn(-1);//如果用户输入的 account 不存在，则返回（-1）
			}else{
				$this -> ajaxReturn($rtn);
			}
	    }
	    

	    /*
		 * Author : zzk
		 * Describe : 找回密码响应，判断邮箱是否存在。
		 */
	    public function is_email(){  //若account存在，判断email是否正确
	    	$account = I('get.account');
	    	$email = I('get.email');
	    	$data = M('usr') -> where("usr_account = '$account'") -> field('usr_email') -> find();
	    	if($data['usr_email'] == "$email"){
	    		$rtn = 1;
	    	}else{
	    		$rtn = -1;
	    	}
	    	$this -> ajaxReturn($rtn);
	    }
}
