<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta name="keywords" content="土豆,博客,前端,后端,技术,前端工程师">
    <meta name="description" content="这是土豆小姐的博客，技术博文分享">
    <meta name="viewport" width="device-width" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="<?php echo ($public_path); ?>admin/css/base.css" rel="stylesheet"/>
    
</head>
<body>
<header class="header">
   <ul class="header_ul">
       <li class="item"><a href="javascript:;">首页</a></li>
       <li class="item"><a href="javascript:;">博文分享</a></li>
       <li class="item"><a href="javascript:;">关于我们</a></li>
       <li class="item"><a href="javascript:;">登录</a>/<a href="javascript:;">注册</a></li>
   </ul>
</header>


 <article class="contianor" id="index">
    <section class="banner">
       <img src=""/>
    </seciton>
    <section class="center">
    </section>
 </article>
<footer class="footer">
  <div class="footer_inner">
      <h1 class="title">您的意见和建议</h1>
      <p class="info">
          请留下对本站的意见和建议吧！对于本站的成长会是很宝贵的留言
      </p>
      <div class="form">
          <div class="input_box info_box">
              <input type="text" placeholder="Name"/>
              <input type="text" placeholder="Email"/>
          </div>
          <div class="input_box msg_box">
              <textarea placeholder="Messege"></textarea>
          </div>
          <button type="button">SEND MESSEGE</button>
      </div>
      <ul class="footer_ul">
          <li class="item"><a href="javascript:;"></a></li>
          <li class="item"><a href="javascript:;"></a></li>
          <li class="item"><a href="javascript:;"></a></li>
      </ul>
  </div>
</footer>
     <script src="https://cdn.jsdelivr.net/npm/vue"></script>
     <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</body>
</html>
<script>
    console.log(vm);
  let vm = new Vue({
     el:"#index",
     data:{
        user:""
     },
     beforeCreate:function(){
        let uid = sessionStorage.getItem('token')?sessionStorage.getItem('token'):localStorage.getItem('token');
        if(!uid){
            window.location.href="./Home/login"
        }else{
           var params = new URLSearchParams();
           let desUid = uid.split("/");
               params.append('uid',desUid[1]);
            var config = {headers: {'X-Requested-With': 'XMLHttpRequest'}};
            axios.post('./home/index/getuid',params,config).then(function(res){
                if(res.status==200&&res.data.code==1){
                    this.user = res.data.username
                }
            });

        }
     }
  })

</script>