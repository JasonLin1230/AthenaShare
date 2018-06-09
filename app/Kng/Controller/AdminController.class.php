<?php

/*
 * Author : JasonLin
 * Describe : admin.
 * Date : 2016/5/31
 */
namespace Kng\Controller;
use Think\Controller;
class AdminController extends Controller {
    //管理员登录
    public function login(){
        $this->display();
    }

    //管理员登录检查
    public function checklog(){
       $usr= I('post.usr');
       $pwd= md5(I('post.pwd'));
       $result = M('admin')->where("admin_account='%s' AND admin_passcode='%s'",$usr,$pwd)->find();
       if($result){
            $_SESSION['admin_id'] = $result['admin_id'];
			$this -> redirect ('Admin/index');
       }else{
            $this->error('登陆失败');
       }
    }

    //检查管理员是否登录
    private function admin_check_login () {
        $admin_id = $_SESSION ['admin_id'];
        if (isset ($admin_id)) {
            return $admin_id;
        } else {
            return -1;
        }
    }

    //管理员退出
    public function logout(){
        session(null);
		$this -> redirect ('Admin/login'); // JasonLin 2018/5/213
    }

    //管理员个人中心页
    public function index(){
    if (($admin_id = $this -> admin_check_login ()) < 0)
        $this -> redirect ('Admin/login');
      $this -> assign('adm_count', M('admin') -> count());
      $this -> assign('usr_count', M('usr') -> count());
      $this -> assign('kng_count', M('kng') -> count());
      $this -> assign('msg_count', M('msg') -> count());
      $this -> display();
    }

    //新增管理员
    public function add_admin(){
        if (($admin_id = $this -> admin_check_login ()) < 0)
            $this -> redirect ('Admin/login');
        $new_data['admin_account'] = I('post.admin_account');
        $new_data['admin_passcode'] = md5(I('post.admin_pass'));
        $result = M("admin") -> add($new_data);
        if($result != false){
            $arr = array('code' => 0,'msg'=>'添加成功！');
        }else{
            $arr = array('code' => 1,'msg'=>'添加失败！');
        }
        print_r(json_encode($arr));
    }

    //用户管理
    public function usr(){
        if (($admin_id = $this -> admin_check_login ()) < 0)
            $this -> redirect ('Admin/login');
        $usr_count = M('usr')->count();  //用户总数
        $page = $_GET ['page'];
        $limit = $_GET ['limit'];
        $usr_data = M("usr as usr")
            ->field('usr.usr_id uid,usr.usr_account name,usr.usr_real_name real_name,usr.usr_phone_num phone,usr.usr_email email,count(kng.kng_id) personal_kng_count')
            ->join('ezsys_kng kng on kng.kng_owner_id = usr.usr_id','left')
            ->limit(($page-1)*$limit,$limit)
            ->group('name')
            ->select();
        $arr = array('code' => 0,'msg'=>'','count' => $usr_count,'data' => $usr_data);
        print_r(json_encode($arr));
    }

    //用户删除
    public function del_usr(){
        if (($admin_id = $this -> admin_check_login ()) < 0)
            $this -> redirect ('Admin/login');
        $uid = $_POST ['uid'];
        $result = M("usr") -> where ("usr_id = $uid") -> delete ();
        if ($result > 0)
            $arr = array('code' => 0,'msg'=>'删除成功');
        else
            $arr = array('code' => 1,'msg'=>'删除失败');
        print_r(json_encode($arr));
    }

    //知识管理
    public function kng(){
        if (($admin_id = $this -> admin_check_login ()) < 0)
            $this -> redirect ('Admin/login');
        $kng_count = M('kng')->count();
        $page = $_GET ['page'];
        $limit = $_GET ['limit'];
        $kng_data = M("kng as k")
            ->field('k.kng_id id,k.kng_name name,c.cate_name cate,u.usr_account owner,k.kng_update_date date,k.kng_file_name file_name,k.kng_like hot')
            ->join('ezsys_cate as c on k.kng_cate_id = c.cate_id','left')
            ->join('ezsys_usr as u on k.kng_owner_id = u.usr_id','left')
            ->limit(($page-1)*$limit,$limit)
            ->order ('kng_update_date desc')
            ->select();
        $arr = array('code' => 0,'msg'=>'','count' => $kng_count,'data' => $kng_data);
        print_r(json_encode($arr));
    }

    //知识删除
    public function del_kng(){
        if (($admin_id = $this -> admin_check_login ()) < 0)
            $this -> redirect ('Admin/login');
        $kid = $_POST ['id'];
        $result = M("kng") -> where ("kng_id = $kid") -> find();
        $file_path= $result['kng_file_path'];
        if($file_path){
            if(file_exists($file_path))
            {
                if(unlink($file_path)){//删除文件
                    //数据库删除
                    $result = M('kng') -> where("kng_id = $kid") ->delete();
                    if($result){
                        $arr = array('code' => 0,'msg'=>'删除成功！');
                    }else{
                        $arr = array('code' => 1,'msg'=>'文件已删除，记录删除失败！');
                    }
                }else{
                    $arr = array('code' => 1,'msg'=>'删除失败！');
                }
            }else{
                //文件已丢失
                $result = M('kng') -> where("kng_id = $kid") ->delete();
                if($result){
                    $arr = array('code' => 0,'msg'=>'文件已丢失，记录删除成功！');
                }else{
                    $arr = array('code' => 1,'msg'=>'文件已丢失，记录删除失败！');
                }
            }
        }else{
            $result = M('kng') -> where("kng_id = $kid") ->delete();
            if($result){
                $arr = array('code' => 0,'msg'=>'没有文件，删除成功！');
            }else{
                $arr = array('code' => 1,'msg'=>'没有文件，删除失败！');
            }
        }
        print_r(json_encode($arr));
    }

    //新增分类
    public function add_cate(){
        if (($admin_id = $this -> admin_check_login ()) < 0)
            $this -> redirect ('Admin/login');

        $catename = $_POST ['catename'];
        $find = M("cate") ->where("cate_name = '$catename'") ->find();
        if($find){
            $arr = array('code' => 1,'msg'=>'该类别已存在！');
        }else{
            $new_data['cate_name'] = $catename;
            $result = M("cate") -> add($new_data);
            if($result){
                $arr = array('code' => 0,'msg'=>'删除成功！');
            }else{
                $arr = array('code' => 1,'msg'=>'删除失败！');
            }
        }
    print_r(json_encode($arr));
    }

    //消息管理
    public function msg(){
        if (($admin_id = $this -> admin_check_login ()) < 0)
            $this -> redirect ('Admin/login');
        $page = $_GET ['page'];
        $limit = $_GET ['limit'];
        $msg_count = M('msg')->count();
//        取消息和发送者
        $msg_data = M("msg as m")
            ->field('m.msg_id mid,m.msg_describe descr,u.usr_account sender,m.msg_update_date date')
            ->join('ezsys_usr as u on m.msg_sender_id = u.usr_id','left')
            ->limit(($page-1)*$limit,$limit)
            ->order('msg_update_date desc')
            ->select();
        //取接收者
        $data = M("usr as usr")
            ->field('usr.usr_account rcver')
            ->join('ezsys_msg msg on msg.msg_rcver_id = usr.usr_id','left')
            ->limit(($page-1)*$limit,$limit)
            ->order('msg_update_date desc')
            ->select();
        for($i=0;$i<$msg_count;$i++)
        {
            $msg_data[$i]['rcver'] = $data[$i]['rcver'];
        }
//        $sql = "SELECT `usr_account` FROM `ezsys_usr` WHERE `usr_id` in (select `msg_sender_id` FROM `ezsys_msg`)";
        $arr = array('code' => 0,'msg'=>'','count' => $msg_count,'data' => $msg_data);
        print_r(json_encode($arr));
    }

    //消息删除
    public function del_msg(){
        if (($admin_id = $this -> admin_check_login ()) < 0)
            $this -> redirect ('Admin/login');
        $mid = $_POST ['mid'];
        $result = M("msg") -> where ("msg_id = $mid") -> delete ();
        if ($result > 0)
            $arr = array('code' => 0,'msg'=>'删除成功');
        else
            $arr = array('code' => 1,'msg'=>'删除失败');
        print_r(json_encode($arr));
    }
}
