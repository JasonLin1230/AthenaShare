<?php

/*
 * Author : JasonLin
 * Describe : 知识项.
 * Date : 2018/6/1
 */
namespace Kng\Controller;
use Kng\Controller\BaseController;

class KngController extends BaseController {
        public function kng(){
            $tab = $_GET ['kng_tab'];
            if($tab == null){//没有获取到
                $kng_tab = -1;
            }else {
                $kng_tab = (int)$tab;
            }
            $this -> kng_tab = $kng_tab;
            $this -> msg_tab = -1;
            $this -> usr_name = $_SESSION ['usr_name'];
            $this -> new_msg_num = new_message_count ();
            $this -> getCate = get_cate();
            $this -> nav_select = 1;
            $this->display();
        }
        public function kng_detail(){
            $this -> usr_name = $_SESSION ['usr_name'];
            $this -> new_msg_num = new_message_count ();
            $this -> nav_select = 1;
            $this -> kng_tab = -1;
            $this -> msg_tab = -1;
            $kng_id = $_GET ['kid'];
            if ($kng_id == null) return;
            $data = M ('Kng')
                -> table ('ezsys_kng kng,ezsys_cate cate,ezsys_usr usr')
                -> where ("kng_id=$kng_id and kng.kng_cate_id = cate.cate_id and kng.kng_owner_id = usr.usr_id")
                -> find ();
            $this -> kid = $kng_id;
            $this -> title = $data ['kng_name'];
            $this -> type = $data ['cate_name'];
            $this -> date = $data ['kng_update_date'];
            $this -> author = $data ['usr_account'];
            $this -> like = $data ['kng_like'];
            if($data ['kng_file_path']){
                $this -> file = "../../" . $data ['kng_file_path'];
            }else{
                $this -> file = 0;
            }
            $this -> content = $data ['kng_describe'];
            $this->display();
        }
		/*
		 * Author : JasonLin
		 * Describe : 个人主页 -> 知识管理 -> 我的发布
		*/
		public function personal_kng_mine () {
		    $id = $_SESSION ['usr_id'];
			$page = $_GET ['page'];
            $limit = $_GET ['limit'];
			$kng = M ('Kng');
            $count = $kng
                -> table ('ezsys_kng kng,ezsys_cate cate')
                -> where ("kng_owner_id = $id and kng_flag = 0 and kng.kng_cate_id = cate.cate_id") -> count ();
			$data = $kng
                -> table ('ezsys_kng kng,ezsys_cate cate')
                -> where ("kng_owner_id = $id and kng_flag = 0 and kng.kng_cate_id = cate.cate_id")
                -> field ('kng.kng_id kid,kng.kng_update_date dt,kng.kng_name name,kng.kng_describe dscr,kng.kng_like lk,kng.kng_cate_id ctid,cate.cate_name ctnm,kng.kng_file_name file_name')
                -> order ('kng_update_date desc')
                -> limit (($page-1)*$limit,$limit)
                -> select ();
            $arr = array('code' => 0,'msg'=>'','count' => $count,'data' => $data);
            print_r(json_encode($arr));
		}

		/*
		 * Author : JasonLin
		 * Describe : 个人主页 -> 知识管理 -> 我的草稿
		*/
		public function personal_kng_script () {
            $usr_id = $_SESSION ['usr_id'];
            $page = $_GET ['page'];
            $limit = $_GET ['limit'];
			$kng = M ('Kng');
            $count = $kng
                -> table ('ezsys_kng kng,ezsys_cate cate')
                -> where ("kng_owner_id=$usr_id and kng_flag = 1 and kng.kng_cate_id = cate.cate_id") -> count ();
            $data = $kng
                -> table ('ezsys_kng kng,ezsys_cate cate')
                -> where ("kng_owner_id=$usr_id and kng_flag = 1 and kng.kng_cate_id = cate.cate_id")
                -> field ('kng.kng_id kid,kng.kng_update_date dt,kng.kng_name name,kng.kng_describe dscr,kng.kng_like lk,kng.kng_cate_id ctid,cate.cate_name ctnm,kng.kng_file_name file_name')
                -> order ('kng_update_date desc')
                -> limit (($page-1)*$limit,$limit)
                -> select ();
            $arr = array('code' => 0,'msg'=>'','count' => $count,'data' => $data);
            print_r(json_encode($arr));
		}

		/*
		 * Author : JasonLin
		 * Describe : 添加知识项实体
		 */
		public function insert_kng () {
            $id = $_SESSION ['usr_id'];
			$data ['kng_flag'] = $_POST ['is_script'];
			$data ['kng_name'] = $_POST ['kng_title'];
			$data ['kng_describe'] = $_POST ['kng_desc'];
			$data ['kng_share'] = $_POST['kng_sharing'];
            $data ['kng_cate_id'] = $_POST['kng_cate'];
            $data ['kng_file_name'] = $_POST['file_name'];
            $data ['kng_file_path'] = $_POST['file_path'];
			$data ['kng_owner_id'] = $id;
			$data ['kng_update_date'] = date("Y-m-d H:i:s");
			$kng = M ('Kng');
            $new_id = $kng -> add ($data);//存入数据库
            if ($new_id > 0)
                $arr = array('code' => 0,'msg'=>'添加成功');
            else
                $arr = array('code' => 1,'msg'=>'添加失败');
            print_r(json_encode($arr));

		}
        #上传文件方法
        public function upload(){
            $id = $_SESSION ['usr_id'];
            $file_name=$_FILES['file']['name'];  //获取文件名
            $file_type=strrchr($file_name,".");  //获取文件后缀

            //获得src库中最大 src_id，用作文件名
            $src = M ('kng');
            $max_id = $src -> max('kng_id');
            $new_max_id = $max_id + 1;
            //文件存储到本地
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     10000000000 ;// 设置附件上传大小
            $upload->exts      =     array('zip','rar','7z','tar.gz');// 设置附件上传类型
            $upload->rootPath  =     "./Uploads/"; // 设置附件上传根目录
            $upload->savePath  =     "./usr_$id/"; // 设置附件上传（子）目录
            $upload->saveName  =     "./src_$new_max_id"; // 设置文件名
            //根目录不存在则创建
            if(!is_dir($upload->rootPath)){
                if(!mkdir("./Uploads/")){
                    $this->error("不能创建Uploads目录");
                    //$this -> ajaxReturn(0);  //不能创建Uploads
                }
            }
            $date=date("Y-m-d");
            $info = $upload->upload();
            if(!$info) {// 上传错误提示错误信息
                $arr = array('code' => 1,'msg'=>$upload->getError());
            }else{
                $arr = array('code' => 0,'msg'=>'文件上传成功','file_name'=>$file_name,'file_path'=>'Uploads/usr_'.$id.'/'.$date.'/src_'.$new_max_id.$file_type);
            }
            print_r(json_encode($arr));
        }
		/*
		 * Author : JasonLin
		 * Describe : 根据传入的kid删除知识项实体
		 */
		public function delete_kng () {
			$id = $_SESSION ['usr_id'];
			$kng_id = $_POST ['kid'];
			$kng = M ('Kng');
			$result = $kng -> where ("kng_id=$kng_id") -> delete ();
            if ($result > 0)
                $arr = array('code' => 0,'msg'=>'删除成功');
            else
                $arr = array('code' => 1,'msg'=>'删除失败');
            print_r(json_encode($arr));
		}

		/*
		 * Author : JasonLin
		 * Describe : 点赞知识点
		 */
		public function like_kng () {
            $kng_id = $_POST ['kid'];
			$id = $_SESSION ['usr_id'];
			$kng = M ('Kng');
            $islike = M ('like')
                -> where ("like_usr=$id and like_kid=$kng_id")
                -> find ();
            if($islike){
                $arr = array('code' => 1,'msg'=>'已经赞过啦');
            }else{
                $res1 = $kng
                    -> where ("kng_id = $kng_id")
                    -> setInc ("kng_like", 1);
                $new_data ['like_usr'] = $id;
                $new_data ['like_kid'] = $kng_id;
                $res2 = M("like") -> add($new_data);
                if ($res1 && $res2)
                    $arr = array('code' => 0,'msg'=>'点赞成功');
                else
                    $arr = array('code' => 1,'msg'=>'点赞失败');
            }
            print_r(json_encode($arr));
		}

        /*
         * Author : JasonLin
         * Describe : 发布草稿
         */
        public function push_draft(){
			$kng_id = $_POST ['kid'];
			$new_data['kng_flag'] = 0;  //将flag设为0：发布
			$new_data['kng_share'] = 0;  //将share设为0：不分享
			$new_data['kng_update_date'] = date("Y-m-d H:i:s");  //更改时间
			$result = M ('Kng') 
				-> where ("kng_id=$kng_id")
				-> save ($new_data);
            if ($result > 0)
                $arr = array('code' => 0,'msg'=>'发布成功，默认私有');
            else
                $arr = array('code' => 1,'msg'=>'发布失败');
            print_r(json_encode($arr));
        }

//        获取评论
        public function get_comment () {
            $my_id = $_SESSION ['usr_id'];
            $page = $_GET ['page'];
            $kid = $_GET ['kid'];
            if(!$page){
                $page = 1;
            }
            $com = M ('Comment');
            $counts = $com
                -> table ('ezsys_comment com')
                -> where ("com.comment_kng_id = $kid") -> count ();
            $data = $com
                -> table ('ezsys_comment com,ezsys_usr usr')
                -> where ("com.comment_kng_id = $kid and com.comment_usr_id = usr.usr_id")
                -> field ('usr.usr_id uid,usr.usr_account author,com.comment_id cid,com.comment_update_date dt,com.comment_describe descr')
                -> order ('comment_update_date desc')
                -> limit (($page-1)*10, 10)
                -> select ();
            $arr = array('code' => 0,'msg'=>'','count' => $counts,'data' => $data,'my_id' => $my_id);
            print_r(json_encode($arr));
        }
        /*
        * Author : JasonLin
        * Describe : 发布评论
        */
        public function new_comment () {
            $id = $_SESSION ['usr_id'];
            $data ['comment_kng_id'] = $_POST ['kid'];
            $data ['comment_describe'] = $_POST ['descr'];
            $data ['comment_usr_id'] = $id;
            $data ['comment_update_date'] = date("Y-m-d H:i:s");
            $com = M ('Comment');
            $new_id = $com -> add ($data);//存入数据库
            if ($new_id > 0)
                $arr = array('code' => 0,'msg'=>'发布成功');
            else
                $arr = array('code' => 1,'msg'=>'发布失败');
            print_r(json_encode($arr));
        }
//        删除评论
        public function del_comment () {
            $cid = $_POST ['cid'];
            $com = M ('Comment');
            $result = $com -> where ("comment_id=$cid") -> delete ();
            if ($result > 0)
                $arr = array('code' => 0,'msg'=>'删除成功');
            else
                $arr = array('code' => 1,'msg'=>'删除失败');
            print_r(json_encode($arr));
        }
}
