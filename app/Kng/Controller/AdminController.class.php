<?php

/*
 * Author : zzk
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
            // $this->success('登陆成功', U ('index/index')); // ez 2016/5/6
						$this -> redirect ('Admin/main'); // ez 2016/5/23
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
        // $this->success('欢迎再来!',U('Login/index'),3);
				$this -> redirect ('Admin/login'); // ez 2016/5/13
    }

    //管理员个人中心页
    public function main(){
    if (($admin_id = $this -> admin_check_login ()) < 0)
        $this -> redirect ('Admin/login');

      $this -> assign('adm_count', M('admin') -> count());
      $this -> assign('usr_count', M('usr') -> count());
      $this -> assign('kng_count', M('kng') -> count());
      $this -> assign('src_count', M('src') -> count());
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
          $this->success('添加成功！');
        }else{
          $this->error('添加失败！');
        }
    }

    //用户管理
    public function admin_usr(){
    if (($admin_id = $this -> admin_check_login ()) < 0)
        $this -> redirect ('Admin/login');

        //分页
        $usr_count = M('usr')->count();  //用户总数
        $page = new \Think\Page($usr_count,8); 
        $show = $page->show();
        $this->assign('page',$show);
        //取所有用户数据(+知识项)
        $usr_data = M("usr as usr")
        ->field('usr.usr_account name,usr.usr_real_name real_name,usr.usr_email email,count(kng.kng_id) personal_kng_count')
        ->join('ezsys_kng kng on kng.kng_owner_id = usr.usr_id','left')
        //->join('ezsys_src src on src.src_owner_id = usr.usr_id')
        ->limit($page->firstRow.','.$page->listRows)
        ->group('name')
        ->select();
        //取所有用户上传资源数
        $data = M("usr as usr")
        ->field('count(src.src_id) personal_src_count')
        ->join('ezsys_src src on src.src_owner_id = usr.usr_id','left')
        ->limit($page->firstRow.','.$page->listRows)
        ->group('usr.usr_account')
        ->select();

        for($i=0;$i<$usr_count;$i++)
        {
            $usr_data[$i]['personal_src_count'] = $data[$i]['personal_src_count'];
        }
        
        $this->assign('usr_data',$usr_data);   
        $this->display();
    }

    //知识管理
    public function admin_kng(){
    if (($admin_id = $this -> admin_check_login ()) < 0)
        $this -> redirect ('Admin/login');
        $cateId = I('get.cateId');
        $keys = I('get.keywords');

        if($cateId == NULL){$cateId=-1;}
        //分类
        $data = M('cate') -> field('cate_id id,cate_name name') -> select ();
        $this -> assign('cate',$data);//所有类别

        $this -> assign('selectCate',$cateId);//将选择的类别回传给页面
        $this -> assign('keys',$keys);//将关键字回传给页面

        //分页
        if($cateId!=-1){
            $map="kng_cate_id='$cateId' and kng_name like '%$keys%'";
        }else{
            $map="kng_name like '%$keys%'";
        }

        $kng_count = M('kng')->where($map)->count();  //用户总数
        $page = new \Think\Page($kng_count,8); 
            //分页跳转的时候保证查询条件
            foreach($map as $key=>$val) {
                $Page->parameter[$key] = urlencode($val);
            }
        $show = $page->show();
        $this->assign('page',$show);

        //取知识项数据
        if($cateId==-1){//获得全部数据
            //数据
            $kng_data = M("kng as k")
            ->field('k.kng_id id,k.kng_name name,c.cate_name cate,u.usr_account owner,k.kng_update_date date,k.kng_like hot')
            ->join('ezsys_cate as c on k.kng_cate_id = c.cate_id','left')
            ->join('ezsys_usr as u on k.kng_owner_id = u.usr_id','left')
            ->where("k.kng_name like '%$keys%'")
            ->limit($page->firstRow.','.$page->listRows)
            ->order ('kng_update_date desc')
            ->select();
        }else{      //根据分类取知识
            //数据
            $kng_data = M("kng as k")
            ->field('k.kng_id id,k.kng_name name,c.cate_name cate,u.usr_account owner,k.kng_update_date date,k.kng_like hot')
            ->join('ezsys_cate as c on k.kng_cate_id = c.cate_id','left')
            ->join('ezsys_usr as u on k.kng_owner_id = u.usr_id','left')
            ->where("k.kng_cate_id='$cateId' and k.kng_name like '%$keys%'")
            ->limit($page->firstRow.','.$page->listRows)
            ->order ('kng_update_date desc')
            ->select();
        }
        
        $this->assign('kng_data',$kng_data);
        $this->display();
    }

    

    //新增分类
    public function add_cate(){
    if (($admin_id = $this -> admin_check_login ()) < 0)
        $this -> redirect ('Admin/login');

        $new_data['cate_name'] = I('post.cateName');

        $result = M("cate") -> add($new_data);
        if($result != false){
          $this->success('添加成功！');
        }else{
          $this->error('添加失败！');
        }
    }

    //删除知识项
    public function delete_kng()
    {
        if (($admin_id = $this -> admin_check_login ()) < 0)
        $this -> redirect ('Admin/login');

        $arrId = I('post.id');
        foreach($arrId as $key => $value){
            $sql = $sql."$value,";
        }
        $sql = substr($sql,0,-1);//删除最后的“,”
        //数据库删除
        $result = M('kng') -> where("kng_id in (".$sql.")") ->delete();
        if($result){
            $this->success('删除成功！');
        }else{
            $this->error('删除失败！');
        }
    }


    //资源管理
    public function admin_src(){
    if (($admin_id = $this -> admin_check_login ()) < 0)
        $this -> redirect ('Admin/login');

        $keys = I('get.keywords');
        $this -> assign('keys',$keys);//将关键字回传给页面
        //分页
        $map="src_name like '%$keys%'";
        $src_count = M('src')->where($map)->count();  //用户总数
        $page = new \Think\Page($src_count,8); 
            //分页跳转的时候保证查询条件
            foreach($map as $key=>$val) {
                $Page->parameter[$key] = urlencode($val);
            }
        $show = $page->show();
        $this->assign('page',$show);

        //取资源数据
        $src_data = M("src as s")
        ->field('s.src_id id,s.src_name name,u.usr_account owner,s.src_update_date date,s.src_down_times down')
        ->join('ezsys_usr as u on s.src_owner_id = u.usr_id','left')
        ->where("s.src_name like '%$keys%'")
        ->limit($page->firstRow.','.$page->listRows)
        ->order ('src_update_date desc')
        ->select();
        
        $this->assign('src_data',$src_data);
        $this->display();
    }


    //删除资源
    public function delete_src()
    {
        if (($admin_id = $this -> admin_check_login ()) < 0)
        $this -> redirect ('Admin/login');

        $arrId = I('post.id');
        foreach($arrId as $key => $value){
            $sql = $sql."$value,";
        }
        $sql = substr($sql,0,-1);//删除最后的“,”
        //本地删除
        $file = $src -> where ("src_id=$src_id") -> find();
        $file_path= $file['src_file_path'];
        //echo "<script>alert('$file_path');</script>";
        if(file_exists($file_path))
        {
            if(unlink($file_path)){//删除文件
                //数据库删除
                $result = M('src') -> where("src_id in (".$sql.")") ->delete();
                if($result){
                    $this->success('删除成功！');
                }else{
                    $this->error('删除失败！');
                }
            }else{
                $this->error("删除文件失败！");
            }
        }else{
            $this->error("本地文件丢失！");
        }
    }
}
