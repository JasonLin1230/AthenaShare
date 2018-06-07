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
            $this -> usr_name = $_SESSION ['usr_name'];
            $this -> new_msg_num = new_message_count ();
            $this -> getCate = get_cate();
            $this->display();
        }
        public function kng_detail(){
            $this -> usr_name = $_SESSION ['usr_name'];
            $this -> new_msg_num = new_message_count ();
            $id = $_SESSION ['usr_id'];
            $kng_id = $_GET ['kid'];
            if ($kng_id == null) return;
            $data = M ('Kng')
                -> table ('ezsys_kng kng,ezsys_cate cate,ezsys_usr usr')
                -> where ("kng_id=$kng_id and kng_owner_id=$id and kng.kng_cate_id = cate.cate_id and kng.kng_owner_id = usr.usr_id")
                -> find ();
            $this -> kid = $kng_id;
            $this -> title = $data ['kng_name'];
            $this -> type = $data ['cate_name'];
            $this -> date = $data ['kng_update_date'];
            $this -> author = $data ['usr_real_name'];
            $this -> like = $data ['kng_like'];
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
			$data = $kng
                -> table ('ezsys_kng kng,ezsys_cate cate')
                -> where ("kng_owner_id = $id and kng_flag = 0 and kng.kng_cate_id = cate.cate_id")
                -> field ('kng.kng_id kid,kng.kng_update_date dt,kng.kng_name name,kng.kng_describe dscr,kng.kng_like lk,kng.kng_cate_id ctid,cate.cate_name ctnm,kng.kng_file_name file_name')
                -> order ('kng_update_date desc')
                -> limit ($page-1,$limit)
                -> select ();
            $count = count($data);
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
            $data = $kng
                -> table ('ezsys_kng kng,ezsys_cate cate')
                -> where ("kng_owner_id=$usr_id and kng_flag = 1 and kng.kng_cate_id = cate.cate_id")
                -> field ('kng.kng_id kid,kng.kng_update_date dt,kng.kng_name name,kng.kng_describe dscr,kng.kng_like lk,kng.kng_cate_id ctid,cate.cate_name ctnm,kng.kng_file_name file_name')
                -> order ('kng_update_date desc')
                -> limit ($page-1,$limit)
                -> select ();
            $count = count($data);
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
			$data ['kng_owner_id'] = $id;
			$data ['kng_update_date'] = date("Y-m-d H:i:s");
			$kng = M ('Kng');

			$new_id = $kng -> add ($data);
			if ($new_id > 0)
                $arr = array('code' => 0,'msg'=>'添加成功');
			else
                $arr = array('code' => 1,'msg'=>'添加失败');
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
		 * Describe : 根据传入的kid获取知识项实体
		 */
		public function get_kng () {
            $usr_id = $_SESSION ['usr_id'];
			$kng_id = $_GET ['kid'];
			if ($kng_id == null) {
				return;
			}

			$data = M ('Kng') -> where ("kng_id=$kng_id and kng_owner_id=$usr_id")
				-> find ();
			$rtn ['title'] = $data['kng_name'];
			$rtn ['desc'] = $data['kng_describe'];
			$rtn ['share'] = $data['kng_share'];
			$this -> ajaxReturn ($rtn, 'json');
		}

		/*
		 * Author : JasonLin
		 * Describe : 根据传入的kid绑定知识项数据到页面kngdisp
		 */
		public function show_kng () {
            $id = $_SESSION ['usr_id'];
			$kng_id = $_GET ['kid'];
			if ($kng_id == null) return;
			$data = M ('Kng') -> where ("kng_id=$kng_id and kng_owner_id=$id")
				-> find ();
			$this -> content = $data ['kng_describe'];
			$this -> display ('kngdisp');
		}

		/*
		 * Author : JasonLin
		 * Describe : 点赞知识点
		 */
		public function like_kng () {
			$id = $_SESSION ['usr_id'];
			$kng_id = $_GET ['kid'];
			$kng = M ('Kng');
			$res1 = $kng
                -> where ("kng_id=$kng_id")
				-> setInc ('kng_like', 1);
            $res2 = $kng
                -> add ("like_usr=$id,like_kid=$kng_id");
            if ($res1 && $res2)
                $arr = array('code' => 0,'msg'=>'点赞成功');
            else
                $arr = array('code' => 1,'msg'=>'点赞失败');
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


        /*
         * Author : JasonLin
         * Describe : 分享知识
         */
        public function share_kng(){
			$kng_id = $_GET ['kid'];
			if ($kng_id == null) return;
			$new_data['kng_share'] = 1;  //将share 设为 1：分享
			$result = M ('Kng') 
				-> where ("kng_id=$kng_id")
				-> save ($new_data);
			if($result==false){
				$rtn = 0;
			}else{
				$rtn = 1;
			}
			$this -> ajaxReturn($rtn);//分享知识  成功：1  失败：0
        }
}