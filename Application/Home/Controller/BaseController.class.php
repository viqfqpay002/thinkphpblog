<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller{
    //设置静态资源路径
    public function __construct(){
        parent::__construct();
        $this->assign('public_path',PUBLIC_PATH);
    }
}


?>