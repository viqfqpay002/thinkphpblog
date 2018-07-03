<?php
  namespace Home\Controller;
  use Think\Controller;
  class LoginController extends BaseController{
    public function index(){
        $this->display("login");
    }
    //登录
    public function login(){
        $basepas =base64_decode($_POST["password"]);
        $form["username"]= $_POST["username"];
        $form["password"]=md5($basepas);
        $form['_logic'] = 'OR';
        $form["phone"] = $_POST["username"];
        $flag = $_POST["flag"];
        $data = M("user");
        $list = $data->where($form)->select();
        if(count($list)>0){
           $arr = array("code"=>1,"msg"=>"登录成功","uid"=>$list[0]["id"]);
           if($flag==true){
              cookie("token" , $list[0]["id"],time()+(30*24*60*60));
           }
              session("token",$list[0]["id"]);
        }else{
           $arr = array("code"=>0,"msg"=>"请确认您的用户名密码");
        }
           echo json_encode($arr);
    }
  }


?>