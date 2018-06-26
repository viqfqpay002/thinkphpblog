<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>首页</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
       <link rel="stylesheet" type="text/css" href="http://localhost/phpdemos/thinkphp/Public/staic/util/bootstrap/css/bootstrap.min.css"/>
   <link rel="stylesheet" type="text/css" href="http://localhost/phpdemos/thinkphp/Public/staic/css/common.css"/>
   <link rel="stylesheet" type="text/css" href="http://localhost/phpdemos/thinkphp/Public/staic/css/form.css"/>
</head>
<body>
      <div class="addAdmin">
        <h1 class="title">添加管理员</h1>
         <div class="form">
           <div class="form-group">
                <label>用户ID:</label>
                <input type="text" name="uid" class="uid" />
                <p class="errinfo"></p>
             </div>
             <div class="form-group">
                <label>用户名:</label>
                <input type="text" name="username" class="username" />
                <p class="errinfo"></p>
             </div>
             <div class="form-group">
               <label>密 码:</label>
               <input type="password" name="password" class="password" />
               <p class="errinfo"></p>
             </div>
             <div class="form-group">
                <label>邮 箱:</label>
                <input type="email" name="email" class="email" />
                <p class="errinfo"></p>
             </div>
             <div class="form-group">
                 <button type="button" class="btn btn-primary" id="submit">提交</button>
                 <button type="button" class="btn btn-danger" class="close">关闭</button>
             </div>
         </div>
      </div>
    <script src="http://localhost/phpdemos/thinkphp/Public/staic/util/jquery.js"></script>
    <script src="http://localhost/phpdemos/thinkphp/Public/staic/util/bootstrap/js/bootstrap.min.js"></script>
    <script>
      function vefiry(ins){
             var inputVal = $.trim(ins.val());
             if(inputVal.length<1){
                ins.siblings('.errinfo').html("此项不能为空！");
                return false;
             }else {
                ins.next('.errinfo').text("");
             }
      };
         $(".uid").blur(function(){
         vefiry($(this));
      });
      $(".username").blur(function(){
         vefiry($(this));
      });
        $(".password").blur(function(){
         vefiry($(this));
      });
        $(".email").blur(function(){
         vefiry($(this));
      });
      $('#submit').click(function(){
      var username = $(".username").val();
      var password = $(".password").val();
      var email = $(".email").val();
      var uid = $(".uid").val();
      if(username!=""&&password!=""&&email!=""&&uid!=""){
           var data = {
            "username":username,
            "password":password,
            "email":email,
            "uid":uid
           };
           $.post('/phpdemos/thinkphp/index/admin/addAdmin',{'data':data},function(res){
              console.log(res);
           })
      }else{
        $(".errinfo").text("此项不能为空！");
      }

      });
    </script>
</body>
</html>