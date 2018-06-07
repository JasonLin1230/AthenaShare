<?php

/*
 * Author : ez
 * Describe : Personal Page.
 * Date : 2016/5/7
 */
namespace Kng\Controller;

use Think\Controller;

class IndexController extends Controller {

	  	/*
		 * Author : ez
		 * Describe : 首页消息页面响应，若没有登录，跳转到login。
		*/
    public function index () {
			if (($uid = check_login ()) > 0) {
				// $this -> success ('You are successfully loged.',U('index/personal_kng_mine'),2); //zzk 2016/5/6
				$this -> personal ($uid);
				$this -> display ('personal'); // ez 2016/5/8
			} else {
				// To login page.
				$this -> display ('Login/index');
			}
   	}

		/*
		 * Author : ez
		 * Describe : 母版页变量初始化
		*/
		private function personal ($usr_id) {
			//session_start ();
			$this -> usr_name = $_SESSION ['usr_name'];
			// zzk 2016/5/28
			$this -> new_msg_num = new_message_count ();
			$this -> getCate = get_cate();
		}


}

