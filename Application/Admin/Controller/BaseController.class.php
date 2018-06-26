<?php
namespace Admin\Controller;
use Think\Controller;
// 指定允许其他域名访问(跨域)
header('Access-Control-Allow-Origin:*');
// 响应类型
header('Access-Control-Allow-Methods:*');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
//公共路径
class BaseController extends Controller{
    public function staic(){
        $this->assign('common_path',COMMON_PATH);
        $this->assign('public_path',PUBLIC_PATH);
    }
//公共模板
    public function common(){
        if(!session('uid')||!cookie('uid')){
            echo "<script>alert('请先登录')</script>
            <script>window.location.href='./login'</script>";
               //$this->success('请登录', './Admin/login');
        }else{
          $uid = session('uid')?session('uid'):cookie('uid');
          $M = M('admin');
          $data = $M->where("id=%d",$uid)->select();
          $this->assign('user',$data[0]['username']);
      }
      $this->display('common/header');
      $this->display('common/slider');
      $this->display('common/footer');
  }
//登出
  public function logOut(){
     session_destroy();
     foreach ($_COOKIE as $key => $value) {
        setcookie($key, null);
    }
    $arr = array(
       "msg"=>"退出系统成功",
       "code"=>"0"
    );
     echo json_encode($arr);
 }


}
?>
