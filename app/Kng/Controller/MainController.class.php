<?php

namespace Kng\Controller;
use Kng\Controller\BaseController;

class MainController extends BaseController {

		/*
		 * Author : JasonLin
		 * Describe : 母版页变量初始化
		*/
		public  function main(){
            $this -> usr_name = session('usr_name');
            $this -> new_msg_num = new_message_count ();
            $this -> kng_tab = -1;
            $this -> msg_tab = -1;
            $this -> display();
        }

		/*
		 * Author : JasonLin
		 * Describe : 主页
		 */
        public function get_count () {
            $page = $_GET ['page'];
            if(!$page){
                $page = 1;
            }
            $kng = M ('Kng');
            $counts = $kng
                -> table ('ezsys_kng kng,ezsys_usr usr,ezsys_cate cate')
                -> where ("kng.kng_share = 1 and kng.kng_flag = 0 and kng.kng_owner_id = usr.usr_id and kng.kng_cate_id = cate.cate_id") -> count ();
            $data = $kng
                -> table ('ezsys_kng kng,ezsys_usr usr,ezsys_cate cate')
                -> where ("kng.kng_share = 1 and kng.kng_flag = 0 and kng.kng_owner_id = usr.usr_id and kng.kng_cate_id = cate.cate_id")
                -> field ('kng.kng_id kid,usr.usr_account acc,kng.kng_update_date dt,kng.kng_name name,kng.kng_describe dscr,kng.kng_like lk,kng.kng_cate_id ctid,cate.cate_name ctnm')
                -> order ('kng_update_date desc')
                -> limit (($page-1)*5, 5)
                -> select ();
            $arr = array('code' => 0,'msg'=>'','count' => $counts,'data' => $data);
            print_r(json_encode($arr));
        }
}
