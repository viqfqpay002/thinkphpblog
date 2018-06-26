<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>用户登录</title>
     <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
     <link href="../<?php echo ($public_path); ?>admin/css/base.css" rel="stylesheet"/>
     <link href="../<?php echo ($public_path); ?>admin/css/login.css" rel="stylesheet"/>
</head>
<body>
   <article class="login flex fl-center">
       <div class="form" id="login">
           <div class="top">
               <img src="../<?php echo ($public_path); ?>admin/images/topimg.png"/>
               <img src="../<?php echo ($public_path); ?>admin/images/login.png">
           </div>
           <div class="form_grop" >
               <div class="input_box">
                   <input type="text" v-model="username" name="username" placeholder="请输入用户名" maxlength="11"/>
               </div>
               <div class="input_box">
                   <input type="password" v-model="password" name="passwrod" placeholder="请输入密码" maxlength="16" minlength="6" />
               </div>
               <div class="input_box">
                   <input type="checkbox" name="flag" @click="checked"/>
                   <span class="flagtext">记住用户名和密码?</span>
               </div>
               <p v-text="errinfo" class="errinfo"></p>
               <button type="button" name="submit" @click="submit">登录</button>
           </div>
       </div>
   </article>
   <script src="https://cdn.jsdelivr.net/npm/vue"></script>
   <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<!--    <script src="https://cdn.bootcss.com/vue-validator/2.1.3/vue-validator.js"></script> -->
   <script src="../<?php echo ($public_path); ?>admin/js/login.js"></script>
</body>
</html>