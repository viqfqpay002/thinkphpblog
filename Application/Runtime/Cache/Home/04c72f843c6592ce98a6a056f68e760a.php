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


<link href="<?php echo ($public_path); ?>home/css/blog.css" rel="stylesheet"/>
<article class="blogdetail" id="detail">
    <div class="inner">
        <div class="url"><a href="/home/blog">博文列表</a>/<a href="javascript:;">博文详情页</a></div>
      <section class="content">
        <div class="img_box">
         <img :src="imgurl" alt="主图" />
     </div>
     <div class="content_box">
        <h3 class="title" v-text="title"></h3>
        <p>发布时间:<span v-text="regTime"></span></p>
        <div class="info" v-html="content"></div>
    </div>
    <div class="miniHeader">
        <a class="sure" href="javascript:;"><span class="icon">赞</span><span v-text="zan"></span></a>
        <a class="fx" href="javascript:;"><span class="icon">分享</span>0<span></span></a>
    </div>
</section>
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
<script src="<?php echo ($public_path); ?>home/js/blogdetail.js"></script>