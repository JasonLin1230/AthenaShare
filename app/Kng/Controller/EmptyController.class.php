<?php
/**
 * Created by PhpStorm.
 * User: JasonLin
 * Date: 2018/6/9
 * Time: 9:40
 */

namespace Kng\Controller;
use Think\Controller;

class EmptyController extends Controller
{
    public function _empty(){
        $this->display('Common/404');
    }
}