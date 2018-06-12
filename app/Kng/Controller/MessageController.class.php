<?php

	/*
	 * Author : JasonLin  2018/6/01
	 * Describe : 个人消息管理。
	*/
namespace Kng\Controller;
use Kng\Controller\BaseController;

class MessageController extends BaseController{
    public function msg(){
        $tab = $_GET ['msg_tab'];
        if($tab == null){//没有获取到
            $msg_tab = -1;
        }else {
            $msg_tab = (int)$tab;
        }
        $this -> msg_tab = $msg_tab;
        $this -> kng_tab = -1;
        $this -> usr_name = $_SESSION ['usr_name'];
        $this -> new_msg_num = new_message_count ();
        $this -> nav_select = 2;
        $this->display();
    }
	/*
	 * Author : JasonLin  2018/6/01
	 * Describe : 显示发送消息列表
	*/
	public function person_msg_send (){
        $id = $_SESSION ['usr_id'];
        $page = $_GET ['page'];
        $limit = $_GET ['limit'];
		$msg = M ('msg');
        $count = $msg
            ->table('ezsys_usr usr,ezsys_msg msg')
            ->where("msg.msg_sender_id = $id and usr.usr_id = msg.msg_rcver_id") -> count ();
        $data = $msg
			->table('ezsys_usr usr,ezsys_msg msg') 
			->where("msg.msg_sender_id = $id and usr.usr_id = msg.msg_rcver_id")
			->field('usr.usr_account account,msg.msg_id msg_id,msg.msg_describe dscrib,msg.msg_update_date date')
			->order ('msg_update_date desc')
            ->limit (($page-1)*$limit,$limit)
			->select();
        $arr = array('code' => 0,'msg'=>'','count' => $count,'data' => $data);
        print_r(json_encode($arr));
	}

    //echo ($msg -> getLastSql()); //打印一下SQL语句，查看一下
	/*
	 * Author : JasonLin  2018/6/1
	 * Describe : 显示已读消息列表
	*/
	public function person_msg_recive(){
        $id = $_SESSION ['usr_id'];
        $page = $_GET ['page'];
        $limit = $_GET ['limit'];
        $msg = M ('msg');
        $count = $msg
            ->table('ezsys_usr usr,ezsys_msg msg')
            ->where("msg.msg_rcver_id = $id and usr.usr_id = msg.msg_sender_id and msg_read = 1") -> count ();
        $data = $msg
            ->table('ezsys_usr usr,ezsys_msg msg')
            ->where("msg.msg_rcver_id = $id and usr.usr_id = msg.msg_sender_id and msg_read = 1")
            ->field('usr.usr_account account,msg.msg_id msg_id,msg.msg_describe dscrib,msg.msg_update_date date')
            ->order ('msg_update_date desc')
            ->limit (($page-1)*$limit,$limit)
            ->select();
        $arr = array('code' => 0,'msg'=>'','count' => $count,'data' => $data);
        print_r(json_encode($arr));
	}



	/*
	 * Author : JasonLin  2018/5/11
	 * Describe : 显示未读消息列表
	*/
	public function person_msg_new(){
        $id = $_SESSION ['usr_id'];
        $page = $_GET ['page'];
        $limit = $_GET ['limit'];
        $msg = M ('msg');
        $count = $msg
            ->table('ezsys_usr usr,ezsys_msg msg')
            ->where("msg.msg_rcver_id = $id and usr.usr_id = msg.msg_sender_id and msg_read = 0") -> count ();
        $data = $msg
            ->table('ezsys_usr usr,ezsys_msg msg')
            ->where("msg.msg_rcver_id = $id and usr.usr_id = msg.msg_sender_id and msg_read = 0")
            ->field('usr.usr_account account,msg.msg_id msg_id,msg.msg_describe dscrib,msg.msg_update_date date')
            ->order ('msg_update_date desc')
            ->limit (($page-1)*$limit,$limit)
            ->select();
        $arr = array('code' => 0,'msg'=>'','count' => $count,'data' => $data);
        print_r(json_encode($arr));
	}

    /*
     * Author : JasonLin  2018/5/11
     * Describe : 消息设为已读
    */
    public function person_msg_read(){
        $id = $_SESSION ['usr_id'];
        $msg_id = $_POST ['msg_id'];
        $msg = M ('msg');
        $data = $msg
            -> where ("msg_id=$msg_id") -> setField('msg_read',1);
        if ($data > 0)
            $arr = array('code' => 0,'msg'=>'操作成功');
        else
            $arr = array('code' => 1,'msg'=>'操作失败');
        print_r(json_encode($arr));
    }



	/*
	 * Author : JasonLin  2018/6/1
	 * Describe : 消息发送
	*/
	public function msg_send_utou(){
		$usr_id = $_SESSION ['usr_id'];
        $reciver = $_POST ['reciver'];
        $describe = $_POST ['describe'];

		//根据用户输入的接受者用户名查询数据库
	 	$rcver_usr = M('usr') -> where("usr_account = '$reciver'") -> field('usr_id') -> find();
		 //发送邮件
		if($rcver_usr == null){
            $arr = array('code' => 1,'msg'=>'该用户不存在');
		}else{
		    $msg = M('msg');
            $new_data['msg_sender_id'] = $usr_id;
            $new_data['msg_rcver_id'] = $rcver_usr['usr_id'];
            $new_data['msg_describe'] = $describe;
            $result = $msg -> add($new_data);
            if ($result > 0)
                $arr = array('code' => 0,'msg'=>'发送成功');
            else
                $arr = array('code' => 1,'msg'=>'发送失败');
        }
        print_r(json_encode($arr));
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
