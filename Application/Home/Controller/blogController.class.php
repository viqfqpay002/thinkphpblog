<?php
namespace Home\Controller;
use Think\Controller;
class BlogController extends BaseController{
    public function index(){
        $this->display('blog');
    }
    //查询所有博文
    public function getItem(){
        $data = M('center');
        $count = $data->count();
        $page = new\Think\Page($count,10);
        $show = $page->show();
        $list = $data->limit($page->firstRow,$page->listRows)->select();
        $arr = array('code' =>1 ,"data"=>$list,"total"=>$page->totalPages,"rows"=>$page->totalRows,"pagerows"=>$page->listRow );
         echo json_encode($arr);
    }
}


?>