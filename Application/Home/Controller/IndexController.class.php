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
    //搜索文章
    public function getTitle(){
      $searchText=I('get.searchText');
      if(!empty($searchText)){
         $form['title'] = array('like','%'.$searchText.'%');
         $data = M('center');
      $list = $data->where($form)->select();
      if(count($list)>0){
         $arr = array("code"=>1,"list"=>$list);
      }else{
         $arr = array("code"=>0,"list"=>"没有符合的选项");
      }
      echo json_encode($arr);
       }
   
    }
}