<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller{
  public function index(){
      $c = A(Base);
      $c->staic();
      $this->display('login');
  }
  public function user(){
    $data['username']= $_POST['username'];
    $data['password']= md5($_POST['password']);
    $flag = $_POST['flag'];
    $form = M('admin');
    $forms = $form->where($data)->select();
     if($data['password']==$forms[0]['password'] && $data['username']==$forms[0]['username']||$data['username']==$forms[0]['phone']){
            $arr = array('data'=>["msg"=>"登录成功","code"=>"01","uid"=>$forms[0]['id']]);
               session('uid',$forms[0]['id']);
            if($flag==true){
               cookie ('uid',$forms[0]['id'], time()+3600*24*30);
             }
        }else{
            $arr=array('data'=>["msg"=>"登录失败,用户名或密码错误","code"=>"02","uid"=>null]);
        }
       echo json_encode($arr);

}
}

?>