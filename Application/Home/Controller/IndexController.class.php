<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){
      $this->display();
    }
    //获取uid查询username
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
    //添加留言
    public function setMsg(){
      $form["nick_name"]= $_POST["name"];
      $form["email"] = $_POST["email"];
      $form["messege"] = $_POST["msg"];
      $form["reg_time"] = $_POST["time"];
      $data = D('msg');
      $data->data($form)->add();
    }
    //获取所有文章列表
    


}