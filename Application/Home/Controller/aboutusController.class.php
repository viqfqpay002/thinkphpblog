<?php
namespace Home\Controller;
use Think\Controller;

class AboutusController extends BaseController{
    public function index(){
        $this->display('aboutus');
    }
    //获取所有留言信息
    public function getMsgList(){
        $data= M('msg');
        $count = $data->count();
        $page = new\Think\Page($count,5);
        $form = $data->limit($page->firstRow,$page->listRows)->select();
        $arr = array("data"=>$form,"total"=>$page->totalRows,"list"=>$page->listRows);
        echo json_encode($arr);
    }
}
?>