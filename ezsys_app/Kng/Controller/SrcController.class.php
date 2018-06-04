<?php

/*
 * Author : JasonLin
 * Describe : 资源.
 * Date : 2018/6/1
 */
namespace Kng\Controller;
use Think\Controller;
class SrcController extends Controller {
    public function src(){
        $this -> usr_name = $_SESSION ['usr_name'];
        $this->display();
    }
		/*
		 * Author : JasonLin
		 * Describe : 个人主页 -> 资源管理 -> 共享资源
		 */
		public function personal_src_share () {
			if (($id = check_login ()) < 0) {
				$this -> redirect ('Login/index');
			}
            $page = $_GET ['page'];
            $limit = $_GET ['limit'];
            $src = M ('src');
            $data = $src
                ->table ('ezsys_src src')
                ->where ("src_owner_id = $id and src_share = 1")
                ->field ('src.src_id src_id,src.src_name name,src.src_down_times times,src.src_describe dscrib,src.src_update_date date')
                ->order ('src_update_date desc')
                ->limit ($page-1,$limit)
                ->select();
            $count = count($data);
            $arr = array('code' => 0,'msg'=>'','count' => $count,'data' => $data);
            print_r(json_encode($arr));
		}



		/*
		 * Author : JasonLin
		 * Describe : 个人主页 -> 资源管理 -> 私有资源
		 */
		public function personal_src_private () {
			if (($id = check_login ()) < 0) {
				$this -> redirect ('Login/index');
			}
            $page = $_GET ['page'];
            $limit = $_GET ['limit'];
            $src = M ('src');
            $data = $src
                ->table ('ezsys_src src')
                ->where ("src_owner_id = $id and src_share = 0")
                ->field ('src.src_id src_id,src.src_name name,src.src_down_times times,src.src_describe dscrib,src.src_update_date date')
                ->order ('src_update_date desc')
                ->limit ($page-1,$limit)
                ->select();
            $count = count($data);
            $arr = array('code' => 0,'msg'=>'','count' => $count,'data' => $data);
            print_r(json_encode($arr));
		}

		/*
		 * Author : JasonLin
		 * Describe : 根据传入的sid删除资源
		 */
		public function delete_src () {    //未删除本地文件
			//session_start ();
			$id = $_SESSION ['usr_id'];
			//$usr_name=$_SESSION ['usr_name'];
			if (! isset ($id)) {
				$this -> redirect ('Login/index');
			}

			$src_id = $_GET ['sid'];
			$src = M ('src');
			$file = $src -> where ("src_id=$src_id") -> find();
			$file_path= $file['src_file_path'];
			//echo "<script>alert('$file_path');</script>";
			if(file_exists($file_path))
			{
				if(unlink($file_path)){
					if ($src_id == null) {
						return;
					}
					$src -> where ("src_id=$src_id") -> delete ();
					$this->ajaxReturn(1);
					//$this -> redirect("personal_src_private");           //直接跳转，不带计时后跳转
					//echo "<script>alert('删除文件成功！');</script>";
				}else{
					$this->ajaxReturn(-1);
					//$this->error("删除文件失败！");
				}
			}else{
				$this->ajaxReturn(-2);
				//$this->error("本地文件丢失！");
			}
			
		}


		 /*
		 * Author : zzk
		 * Describe : 上传资源实体
		 */
		public function upload_src () {
			$id = $_SESSION ['usr_id'];
			if (! isset ($id)) {
				$this -> redirect ('Login/index');
			}
			//$usr_name=$_SESSION ['usr_name'];   //获取用户真实姓名
			$file_name=$_FILES['src_file']['name'];  //获取文件名
			$file_type=strrchr($file_name,".");  //获取文件名
			$date=date("Y-m-d");
			//获得src库中最大 src_id
			$src = M ('src');
			$max_id = $src -> max('src_id');
			$new_max_id = $max_id + 1;
		    //文件存储到本地
			$upload = new \Think\Upload();// 实例化上传类
		    $upload->maxSize   =     10000000000 ;// 设置附件上传大小
		    $upload->exts      =     array('zip','tar.gz');// 设置附件上传类型
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
		    // 上传文件 
		    $info = $upload->upload();
		    if(!$info) {// 上传错误提示错误信息
		   		 $this->error($upload->getError());
		   		 //$this->ajaxReturn($info);   //上传失败
		   	}else{// 上传成功
		    //添加到数据库
		    	$data ['src_file_name'] = $file_name;
		    	$data ['src_file_path'] = "Uploads/usr_".$id."/".$date."/src_".$new_max_id.$file_type;
				$data ['src_name'] = $_POST ['src_name'];
				$data ['src_describe'] = $_POST ['src_desc'];
				$data ['src_share'] = $_POST ['src_sharing'];
				$data ['src_owner_id'] = $id;
				$result = $src -> add ($data);
				$this->success("文件上传成功！");
		        //$this->ajaxReturn(1);   //成功，并添加到数据库
		    }
		}


		/*
		 * Author : zzk
		 * Describe : 根据传入的sid获取资源实体
		 */
		public function get_src () {
			//session_start ();
			$id = $_SESSION ['usr_id'];
			if (! isset ($id)) {
				$this -> redirect ('Login/index');
			}

			$src_id = $_GET ['sid'];
			if ($src_id == null) {
				return;
			}

			$data = M ('src') 
			-> table('ezsys_usr usr,ezsys_src src') 
			-> field('usr.usr_account account,src.*')
			-> where ("src.src_id=$src_id and src.src_owner_id=usr.usr_id")
			-> find ();
			$this -> ajaxReturn ($data);
		}


		/*
		 * Author : zzk
		 * Describe : 下载资源，该资源的下载次数加一
		 */
		public function download_src(){
			$id=$_SESSION['usr_id'];
			if($id<0){
				$this -> redirect ('Login/index');
			}

			$src_id = $_GET['sid'];
			if($src_id == null) {
				return;
			}
			$src = M ('src');
			$data = $src -> find ($src_id);           //src 表主键为 src_id，find(1)相当于查询 src_id=1 的数据
			$file = $data['src_file_path'];
			$file_name = $data['src_file_name'];
			if(file_exists($file)){
		        $length = filesize($file);
		        //$type = mime_content_type($file);
		        //header("Content-Description: File Transfer");
		        //header('Content-type: ' . $type);
		        header('Content-Length:' . $length);
				if (preg_match('/MSIE/', $_SERVER['HTTP_USER_AGENT'])) { //for IE
					header('Content-Disposition: attachment; filename="' . rawurlencode($file_name) . '"');
				}else{
					header('Content-Disposition: attachment; filename="' . $file_name . '"');
				}
				readfile($file);
				//下载次数 + 1
				$src -> where ("src_id = $src_id ") -> setInc ('src_down_times', 1);
		        //$this->ajaxReturn(1);
		    }else{
		   		//$this->ajaxReturn(-2);
		        //$this->error('文件不存在！');
		    }
		}
}
