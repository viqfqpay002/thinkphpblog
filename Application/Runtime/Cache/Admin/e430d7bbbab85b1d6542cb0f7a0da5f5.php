<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
 <html>
 <head>
     <title>后台管理</title>
     <link href="<?php echo ($public_path); ?>admin/css/base.css" rel="stylesheet"/>
     <script src="https://cdn.jsdelivr.net/npm/vue"></script>
     <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <!--    <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css"> -->
 </head>
 <body >
<header class="header" id="header">
 <div class="header_logo">
     <a href="javascript:;">博客后台管理</a>
 </div>
 <ul class="headr_box">
     <li class="item">欢迎回来<a href="javascript:;"><?php echo ($user); ?></a></li>
     <li class="item"><a href="/Admin/index/addnew">新建博文</a></li>
     <li class="item"><a href="/Admin">博客文章</a></li>
     <li class="item" ><a href="javascript:;" @click="logout()">退出系统</a></li>
 </ul>
</header>
<script>
    var vm = new Vue({
     el:"#header",
     data:{
     },
     beforeCreate: function(){
     },
     methods: {
        logout:function(){
           axios.get('./index/logOut').then(function(res){
               if(res.data.code==0){
                window.location.href="./login"
               }
           })
        }
     }


})
</script>