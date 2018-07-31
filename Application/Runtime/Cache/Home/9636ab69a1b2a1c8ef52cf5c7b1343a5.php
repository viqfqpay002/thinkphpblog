<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta name="keywords" content="土豆,博客,前端,后端,技术,前端工程师">
    <meta name="description" content="这是土豆小姐的博客，技术博文分享">
    <meta name="viewport" width="device-width" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="<?php echo ($public_path); ?>home/css/base.css" rel="stylesheet"/>
</head>
<body>
<header class="header">
   <ul class="header_ul" id="header">
       <li class="item"><a href="/" :class="{'active':home?'active':''}">首页</a></li>
       <li class="item"><a href="/home/blog" :class="{'active':blog?'active':''}">博文分享</a></li>
       <li class="item"><a href="/home/aboutus" :class="{'active':aboutus?'active':''}">留言信息</a></li>
       <li class="item" v-show="itemShow==false"><a href="/home/login">登录</a>/<a href="/home/register">注册</a></li>
       <li class="item" v-show="itemShow==true"><a href="javascript:;" v-text="user"></a>/<a href="javascript:;" @click="logout()">退出</a></li>
   </ul>
</header>


<link href="<?php echo ($public_path); ?>home/css/about.css" rel="stylesheet" />
<article class="about" id="about">
  <div class="about_content" >
    <h3 class="title">留言信息</h3>
      <ul class="aboutUl">
          <li class="item" v-for="item in items">
              <div class="minHeader">
                  <span class="user" v-text="item.nick_name"></span>
                  <span class="time" v-text="item.reg_time"></span>
              </div>
              <div class="content"><p v-text="item.messege"></p></div>
              <a href="javascript:;" class="btn">回复</a>
          </li>
      </ul>
  </div>
  <!-- 分页 -->
     <div class="paging flex fl-center">
        <a href="javascript:;" @click="pageTabHanlder(-1)">上一页</a>
          <ul class="pagUl flex">
           <li class="item" v-for="item in total"><a href="javascript:;" @click="pageHanlder(item)" :class="{'active':item==thispage?true:false}">{{item}}</a></li>
         </ul>
         <a href="javascript:;" @click="pageTabHanlder(1)">下一页</a>
      </div>
</article>
<footer class="footer" id="footer">
  <div class="footer_inner">
      <h1 class="title">您的意见和建议</h1>
      <p class="info">
          请留下对本站的意见和建议吧！对于本站的成长会是很宝贵的留言
      </p>
      <div class="form">
          <div class="input_box info_box">
              <input type="text" placeholder="Name" v-model="name" required />
              <input type="text" placeholder="Email" v-model="email" required />
          </div>
          <div class="input_box msg_box">
              <textarea placeholder="Messege" class="msgtext" v-model="msg" required></textarea>
          </div>
          <p v-text="errinfo" class="errinfo"></p>
          <button type="button" class="btn" @click="submitHandler">SEND MESSEGE</button>
      </div>
      <ul class="footer_ul">
          <li class="item"><a href="javascript:;"></a></li>
          <li class="item"><a href="javascript:;"></a></li>
          <li class="item"><a href="javascript:;"></a></li>
      </ul>
  </div>
<!--   <div class="markBox" v-show="mark==true">
     <div class="markInner">
          提交成功！
     </div>
  </div> -->
</footer>
     <script src="https://cdn.jsdelivr.net/npm/vue"></script>
     <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
     <script src="<?php echo ($public_path); ?>home/js/formdate.js"></script>
     <script src="<?php echo ($public_path); ?>home/js/common.js"></script>
</body>
</html>
<script src="<?php echo ($public_path); ?>home/js/aboutus.js"></script>