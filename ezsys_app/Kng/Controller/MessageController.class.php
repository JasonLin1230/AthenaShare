<?php

	/*
	 * Author : JasonLin  2018/6/01
	 * Describe : 个人消息管理。
	*/
namespace Kng\Controller;
use Think\Controller;
class MessageController extends Controller{
    public function msg(){
        $this -> usr_name = $_SESSION ['usr_name'];
        $this -> new_msg_num = new_message_count ();
        $this->display();
    }
	/*
	 * Author : JasonLin  2018/6/01
	 * Describe : 显示发送消息列表
	*/
	public function person_msg_send (){
		if(($usr_id = check_login ()) < 0) { 
			$this -> redirect ('Login/index'); 
		}
        $page = $_GET ['page'];
        $limit = $_GET ['limit'];
		$msg = M ('msg');
        $data = $msg
			->table('ezsys_usr usr,ezsys_msg msg') 
			->where("msg.msg_sender_id = $usr_id and usr.usr_id = msg.msg_rcver_id")
			->field('usr.usr_account account,msg.msg_id msg_id,msg.msg_describe dscrib,msg.msg_update_date date')
			->order ('msg_update_date desc')
            ->limit ($page-1,$limit)
			->select();
        $count = count($data);
        $arr = array('code' => 0,'msg'=>'','count' => $count,'data' => $data);
        print_r(json_encode($arr));
	}

    //echo ($msg -> getLastSql()); //打印一下SQL语句，查看一下
	/*
	 * Author : JasonLin  2018/6/1
	 * Describe : 显示已读消息列表
	*/
	public function person_msg_recive(){
		if(($usr_id = check_login ()) < 0) { 
			$this -> redirect ('Login/index'); 
		}
        $page = $_GET ['page'];
        $limit = $_GET ['limit'];
        $msg = M ('msg');
        $data = $msg
            ->table('ezsys_usr usr,ezsys_msg msg')
            ->where("msg.msg_rcver_id = $usr_id and usr.usr_id = msg.msg_sender_id and msg_read = 1")
            ->field('usr.usr_account account,msg.msg_id msg_id,msg.msg_describe dscrib,msg.msg_update_date date')
            ->order ('msg_update_date desc')
            ->limit ($page-1,$limit)
            ->select();
        $count = count($data);
        $arr = array('code' => 0,'msg'=>'','count' => $count,'data' => $data);
        print_r(json_encode($arr));
	}



	/*
	 * Author : zzk  2016/5/11
	 * Describe : 显示未读消息列表
	*/
	public function person_msg_new(){
		if(($usr_id = check_login ()) < 0) { 
			$this -> redirect ('Login/index'); 
		}
        $page = $_GET ['page'];
        $limit = $_GET ['limit'];
        $msg = M ('msg');
        $data = $msg
            ->table('ezsys_usr usr,ezsys_msg msg')
            ->where("msg.msg_rcver_id = $usr_id and usr.usr_id = msg.msg_sender_id and msg_read = 0")
            ->field('usr.usr_account account,msg.msg_id msg_id,msg.msg_describe dscrib,msg.msg_update_date date')
            ->order ('msg_update_date desc')
            ->limit ($page-1,$limit)
            ->select();
        $count = count($data);
        $arr = array('code' => 0,'msg'=>'','count' => $count,'data' => $data);
        print_r(json_encode($arr));
	}



	/*
	 * Author : zzk  2016/5/11
	 * Describe : 个人消息发送 ：用户 TO 用户。
	*/
	public function msg_send_utou(){    //cate : 2 （用户）
		if(check_login()<0){ $this -> redirect('Login/index'); }
		$usr_id = $_SESSION ['usr_id'];
		$reciver = I('post.reciver');//获得接受者用户名
		$describe = I('post.describe');
		//$this -> ajaxReturn ($_POST);

		//根据用户输入的接受者用户名查询数据库
	 	$rcver_usr = M('usr') -> where("usr_account = '$reciver'") -> field('usr_id') -> find();
		 //发送邮件
		if($rcver_usr == null){
			$this -> ajaxReturn(-1);
		}
		$msg = M('msg');
		$new_data['msg_sender_id'] = $usr_id;
		$new_data['msg_sender_cate'] = 2;
		$new_data['msg_rcver_id'] = $rcver_usr['usr_id'];
		$new_data['msg_rcver_cate'] = 2;
		$new_data['msg_describe'] = $describe;
		$result = $msg -> add($new_data);
		if($result == false){
			$rtn = -1;
		}else {
			$rtn = 1;
		}
		$this -> ajaxReturn ($rtn);
	}



	/*
	 * Author : zzk  2016/5/11
	 * Describe : 个人消息发送 ：用户 TO 管理员。
	*/
	public function msg_send_utoa(){    //cate : 1 （管理员）
		if(check_login()<0){ $this -> redirect('Login/index'); }
		$usr_id = $_SESSION ['usr_id'];
		$describe = I('post.describe');

		//发送邮件
		$msg = M('msg');
		$new_data['msg_sender_id'] = $usr_id;
		$new_data['msg_sender_cate'] = 2;
		//$new_data['msg_rcver_id'] = '';
		$new_data['msg_rcver_cate'] = 1;
		$new_data['msg_describe'] = $describe;
		$result = $msg -> add($new_data);
		if($result == false){
			$rtn = -1;
		}else {
			$rtn = 1;
		}
		$this -> ajaxReturn ($rtn);
	}


	/*
	 * Author : zzk  2016/5/11
	 * Describe : 个人消息发送 ：管理员 TO 用户。
	*/
	public function msg_send_atou(){
		//if(check_login()<0){ $this -> redirect('Login/index'); }
		//$usr_id = $_SESSION ['usr_id'];
		$reciver = I('post.reciver');//获得接受者用户名
		$describe = I('post.describe');

		//根据用户输入的接受者用户名查询数据库
		$rcver_usr = M('usr') -> where("usr_account = '$reciver'") -> field('usr_id') -> find();
		//发送邮件
		if($rcver_usr == null){
			$this -> ajaxReturn(-1);
		}
		$msg = M('msg');
		//$new_data['msg_sender_id'] = $usr_id;
		$new_data['msg_sender_cate'] = 1;
		$new_data['msg_rcver_id'] = $rcver_usr['usr_id'];
		$new_data['msg_rcver_cate'] = 2;
		$new_data['msg_describe'] = $describe;
		$result = $msg -> add($new_data);
		if($result == false){
			$rtn = -1;
		}else {
			$rtn = 1;
		}
		$this -> ajaxReturn ($rtn);
	}



	/*
	 * Author : zzk  2016/5/11
	 * Describe : 消息发送 ：系统（所有人可收到）。
	*/
	public function msg_send_sys(){
		//if(check_login()<0){ $this -> redirect('Login/index'); }
		//$usr_id = $_SESSION ['usr_id'];

		$describe = I('post.describe');

		//发送邮件
		$msg = M('msg');
		$new_data['msg_sender_id'] = 0;
		$new_data['msg_sender_cate'] = 0;
		$new_data['msg_rcver_id'] = 0;
		$new_data['msg_rcver_cate'] = 0;
		$new_data['msg_describe'] = $describe;
		$result = $msg -> add($new_data);
		if($result == false){
			$rtn = -1;
		}else {
			$rtn = 1;
		}
		$this -> ajaxReturn ($rtn);
	}


	/*
	 * Author : zzk  2016/5/11
	 * Describe : 选择接受用户后，若存在则返回该用户的真实姓名。
	*/
	public function get_name_by_account(){
		if(check_login()<0){ $this -> redirect('Login/index'); }
		$usr_id = $_SESSION ['usr_id'];

		$reciver = I('get.reciver');//获得接受者用户名

		$rtn = M('usr') -> where("usr_account = '$reciver'") -> field('usr_id,usr_real_name') -> find();
		if($rtn == null){
			$this -> ajaxReturn(-1);//如果用户输入的 usr_account 不存在，则返回（-1）
		}else{
			$this -> ajaxReturn($rtn);
		}
	}




	/*
	 * Author : zzk  2016/5/11
	 * Describe : 获得消息详细信息
	*/
	public function get_msg(){
		if(check_login()<0){ $this -> redirect('Login/index'); }
		$usr_id = $_SESSION ['usr_id'];

		$msg_id = I('get.kid');
		$msg_lab = I('get.lab');  //0：已发消息    1：已读消息    2：未读消息
		if ($msg_id == null) {
			return;
		}
		$data = M ('msg') 
				->where("msg_id=$msg_id")
				->find ();
		if($msg_lab == 0){  //已发消息
			if($data['msg_rcver_cate'] == 1){ //管理员
				$rtn['account'] = "管理员";
			}else if($data['msg_rcver_cate'] ==2){   //用户
				$rcver_id = $data['msg_rcver_id'];
				$rtn['account'] = M('usr') -> field('usr_account') -> where ("usr_id=$rcver_id") -> find();
			}else{
				$rtn['account'] = "";
			}
		}else if($msg_lab == 1){   //已读消息
			if($data['msg_sender_cate'] == 0){  //系统
				$rtn['account'] = "系统";
			}else if($data['msg_sender_cate'] == 1){ //管理员
				$rtn['account'] = "管理员";
			}else if($data['msg_sender_cate'] ==2){   //用户
				$sender_id = $data['msg_sender_id'];
				$rtn['account'] = M('usr') -> field('usr_account') -> where ("usr_id=$sender_id") -> find();
			}else{
				$rtn['account'] = "";
			}
		}else if($msg_lab == 2){   //未读消息
			if($data['msg_sender_cate'] == 0){  //系统
				$rtn['account'] = "系统";
			}else if($data['msg_sender_cate'] == 1){ //管理员
				$rtn['account'] = "管理员";
			}else if($data['msg_sender_cate'] ==2){   //用户
				$sender_id = $data['msg_sender_id'];
				$rtn['account'] = M('usr') -> field('usr_account') -> where ("usr_id=$sender_id") -> find();
			}else{
				$rtn['account'] = "";
			}
			//将该消息设为已读
			M('msg') -> where ("msg_id=$msg_id") -> setField('msg_read',1);
		}
		$rtn['desc'] = $data['msg_describe'];
		$rtn['date'] = $data['msg_update_date'];
		$this -> ajaxReturn ($rtn, 'json');
	}


	/*
	 * Author : JasonLin
	 * Describe : 根据传入的kid删除知识项实体
	 */
	public function delete_msg () {
		$usr_id = $_SESSION ['usr_id'];
        $msg_id = $_POST ['msg_id'];
		$result = M('msg') -> where ("msg_id=$msg_id") -> delete ();
        if ($result > 0)
            $arr = array('code' => 0,'msg'=>'删除成功');
        else
            $arr = array('code' => 1,'msg'=>'删除失败');
        print_r(json_encode($arr));
	}
      
}
