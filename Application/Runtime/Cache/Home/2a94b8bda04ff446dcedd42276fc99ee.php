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


<link href="<?php echo ($public_path); ?>home/css/home.css" rel="stylesheet" />
 <article class="continaor home" id="index">
   <section class="left">
      <div class="img_box">
          <img src="<?php echo ($public_path); ?>home/images/m2.jpg"/>
      </div>
      <ul class="ulbox">
          <li class="item" @click="sliderHandle('blog')"><a href="javascript:;">所有文章</a></li>
          <li class="item" @click="sliderHandle('about')"><a href="javascript:;">关于我们</a></li>
      </ul>
   </section>
   <transtion name="slide-fade">
    <section v-show="blogShow" class="blogShow">
   <section class="textShow">
       <div class="search_box">
           <div class="input_box">
             <input type="text" name="search" placeholder="请输入搜索内容" v-model="searchText" @keyup = "getTitle"/>
             <span class="btn search_btn" @click="getTitle">搜索</span>
              <transtion name="fade">
             <ul class="selectList" v-show='flag'>
               <li class="item" v-for='(item,index) in selectList'>
                <a href="javascript:;" v-text="item.title" @click="getItem(item)"></a>
              </li>
               <span :key="0" v-if="selectList.length<1">没有符合条件的选项</span>
             </ul>
           </transtion>
           </div>
           <ul class="ulbox">
                <li v-for="(item,index) in items" class="item">
                  <a href="javacript:;" v-text="item.title" @click="itemSelect(item)"></a>
                </li>
           </ul>
       </div>
   </section>
   <section class="right">
       <h3 class="title"><span v-text="title"></span> <time>发布时间:<span v-text="time"></span></time></h3>
       <div class="img_box">
           <img :src="img" alt="文章图片"/>
       </div>
       <div class="content" v-html="content"></div>
   </section>
 </section>
      </transtion>
      <transtion name="slide-fade">
        <section class="about" v-show="aboutShow">
           一个90后半路出家的草根尼姑！！，，具体内容稍后......
        </section>
      </transtion>
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
<script src="<?php echo ($public_path); ?>home/js/home.js"></script>