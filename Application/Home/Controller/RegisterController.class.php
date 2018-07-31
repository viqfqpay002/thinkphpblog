<?php
  namespace Home\Controller;
  use Think\Controller;
  class RegisterController extends BaseController{
     public function index(){
        $this->display("Register");
     }
     //验证码
     public function setVegImg(){
        $Verify = new \Think\Verify();
        $Verify->useImgBg = true;
        $Verify->fontSize="30";
        $Verify->entry();
     }
     //验证码校验
     public function  checkVeg(){
          $code=I('get.vegCode');
          $verify = new \Think\Verify();
          $res = $verify->check($code);
          $arr = array('msg'=>$res);
          echo json_encode($arr);
     }
     public function register(){
          $form['username'] = $_POST['username'];
          $form['phone']=$_POST['phone'];
          $basepas =base64_decode($_POST["password"]);
          $form['password']= md5($basepas);
          $form['reg_time'] = $_POST['reg_time'];
          $data = M('user');
          $list = $data->where('phone='.$form['phone'])->select();
          if(!$list){
              $data->data($form)->add();
              $arr = array('msg'=>"注册成功,请登录",'code'=>1);
          }else{
              $arr = array('msg'=>"此手机用户已存在",'code'=>0);
          }
            echo json_encode($arr);
          }
     }

?>