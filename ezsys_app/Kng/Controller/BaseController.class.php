<?php
/**
 * Created by PhpStorm.
 * User: JasonLin
 * Date: 2018/6/4
 * Time: 7:31
 */
namespace Kng\Controller;
use think\Controller;

// 指定允许其他域名访问
header('Access-Control-Allow-Origin:*');
// 响应类型
header('Access-Control-Allow-Methods:*');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');

class BaseController extends Controller
{
    //初始化方法
    public function _initialize(){
        if(!$_SESSION ['usr_id']){
            $this->redirect('Login/index');
        }
    }
    //修改密码
    public function ex_pass() {
        $usr_id = $_SESSION ['usr_id'];
        $passcode = md5 ($_POST ['old_pass']);
        $new_passcode = md5 ($_POST ['new_pass']);

        $usr = M ('usr');
        $data = $usr -> find ($usr_id);
        if($passcode != $data ['usr_passcode']) {
            $arr = array('code' => 1,'msg'=>'原密码错误');
        } else {
            $new_data ['usr_passcode'] = $new_passcode;
            $rtn = $usr -> where ("usr_id=$usr_id") -> save ($new_data);
            if ($rtn != 1){
                $arr = array('code' => 1,'msg'=>'修改失败');
            } else {
                session(null);
                $arr = array('code' => 0,'msg'=>'修改成功,请重新登录');
            }
        }
        print_r(json_encode($arr));
    }
}