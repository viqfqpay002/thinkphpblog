<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>登录页面</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
   <link rel="stylesheet" type="text/css" href="http://localhost/phpdemos/thinkphp/Public/staic/util/bootstrap/css/bootstrap.min.css"/>
   <link rel="stylesheet" type="text/css" href="http://localhost/phpdemos/thinkphp/Public/staic/css/login.css"/>
</head>
<body>
    <div class="wrap container login">
        <h1 class="title col-md-12">后台管理系统</h1>
        <div class="form_wrap col-md-12">
             <h3 class="col-md-12 minititle">登录</h3>
             <div class="input-group col-md-12">
                 <label class="input-group-addon col-md-2">用户名:</label>
                 <input type="text" name="username" class="username form-control" />
             </div>
             <div class="input-group col-md-12 passwordbox">
                 <label class="input-group-addon col-md-2">密码:</label>
                 <input type="password" name="password" class="password form-control" />
             </div>
             <div class="input-group checkbox col-md-12">
                 <input type="checkbox" name="trueFlag" class="form-control"/>
                 <label class="input-group-addon">记住密码?</label>
             </div>
             <p class="errinfo"></p>
             <input type="button" value="提交" class="btn btn-default btn-primary"/>
             <div class="loading" style="display: none;">
                 加载中....
             </div>
        </div>
    </div>
    <script src="http://localhost/phpdemos/thinkphp/Public/staic/util/jquery.js"></script>
    <script src="http://localhost/phpdemos/thinkphp/Public/staic/util/bootstrap/js/bootstrap.min.js"></script>
    <script>
              $(".btn").click(function(){
                var username =$.trim($(".username").val());
                var password = $.trim($(".password").val());
                var trueFlag = $("input[name='trueFlag']");
                $(".loading").show();
                $.post('/phpdemos/thinkphp/login/login',{username:username,password:password},function(res){
                 if(res.data.uid!==""){
                  if(trueFlag.is(':checked')){
                    localStorage.setItem('uid',res.data.uid);
                    localStorage.setItem("uname",res.data.uname)
                  }
                   $(".loading").hide();
                    sessionStorage.setItem("uid", res.data.uid);
                    sessionStorage.setItem("uname",res.data.uname);
                     window.location.href="<?php echo U('index/index');?>";
                }else {
                    $(".errinfo").text(res.data.msg);
                     window.localtion.href="<?php echo U('login/index');?>";
                }
              });
              });

    </script>
</body>
</html>