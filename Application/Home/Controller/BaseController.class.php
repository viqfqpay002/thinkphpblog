<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller{
    public function __construct(){
        parent::__construct();
        $this->assign('public_path',PUBLIC_PATH);
    //  $ctoken = $_COOKIE['token'];
    //  $stoken = $_SESSION['token'];
    //  if($ctoken==""&&$stoken==""){
    //     echo "<script> window.location.href='/Home/login' </script>";
    // }else{
    //     $user = $stoken==""?$ctoken:$stoken;
    //     echo json_encode($user);
    // }
    }
}


?>