<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){
      $this->display();
    }
    public function getuid(){
        $uid = $_POST["uid"];
        $data = M('user');
        $list = $data->where("id=".$uid)->select();
        if(count($list)>0){
           $arr = array("code"=>1,"username"=>$list[0]["username"]);
        }else{
           $arr = array("code"=>0);

        }
        echo json_encode($arr);
    }


}