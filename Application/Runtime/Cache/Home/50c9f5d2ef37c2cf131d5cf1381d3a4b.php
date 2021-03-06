<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>登录页面</title>
    <meta name="viewport" width="device-width" content="width=device-width, initial-scale=1">
    <link href="<?php echo ($public_path); ?>home/css/base.css" rel="stylesheet"/>
    <link href="<?php echo ($public_path); ?>home/css/form.css" rel="stylesheet"/>
</head>
<body>
<section class="login form" id="login">
    <div class="form_inner">
        <h3 class="title">登录页面</h3>
        <div class="input_box">
            <input type="text" placeholder="请输入用户名/手机号码" required v-model="username" @input="userVer()" :class="{'errInput':userinput}"/>
            <span class="errinfo" v-text="userError"></span>
        </div>
        <div class="input_box">
            <input type="password" min="6" placeholder="请输入密码" required v-model="password" @input="pasVer()" :class="{'errInput':pasinput}"/>
             <span class="errinfo" v-text="pasError"></span>
        </div>
        <button type="button" class="btn submit" @click="submitHandler()">登录</button>
         <div class="input_box checkbox">
             <input type="checkbox" @click="flagHanlder()" v-model="flag"/>
             <span>记住密码?</span>
         </div>
         <p class="link_go">有无注册?<a href="/home/register/">去注册</a></p>
    </div>
    <div class="mark" v-show="submitHandler">
        <span class="icon"></span>
        <span class="info" v-text="successInfo"></span>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</body>
</html>
<script>
    var vm = new Vue({
        el:"#login",
        data:{
            username:"",
            password:"",
            userError:"",
            pasError:"",
            errinfo:{
              user:{
              "msg2":"输入的用户名格式不正确",
              "reg":"^[A-Za-z0-9_]{5,15}$"
              },
              pas:{
                "msg2":"密码不少于6位,至少包含一个大写字母",
                "reg":"^([A-Z]|[a-z]|[0-9]|[`~!@#$%^&*()+=|{}':;',\\\\[\\\\].<>/?~！@#￥%……&*（）——+|{}【】‘；：”“'。，、？]){6,20}$"
              }
            },
            flag:false,
            successInfo:"",
            userinput:false,
            pasinput:false
        },
        methods:{
            userVer : function(){
               let reg = new RegExp(this.errinfo.user.reg);
               let user = this.username;
              if(reg.test(user)==false){
                 this.userError = this.errinfo.user.msg2;
                 this.userinput=true;
                 return false
                 }
              else if(user.length<1){
                 this.userError=this.errinfo.user.msg1;
                 this.userinput=true;
                 return false
              }else {
                  this.userError="";
                  this.userinput=false;
                  return true
              }
            },
            pasVer: function(){
              let reg = new RegExp(this.errinfo.pas.reg);
              let pas = this.password;
              if(reg.test(pas)==false){
                 this.pasError = this.errinfo.pas.msg2;
                 this.pasinput=true;
                 return false
              }
              else if(pas.length<1){
                 this.pasError=this.errinfo.pas.msg1;
                 this.pasinput=true;
                 return false
              }else {
                  this.pasError="";
                  this.pasinput=false;
                  return true
              }
            },
            flagHanlder:function(){
                this.flag= !this.flag
            },
            submitHandler: function(){
                var _self= this;
                if(this.userVer()&&this.pasVer()){
                var params = new URLSearchParams();
                 params.append('username', this.username);
                 params.append('password', window.btoa(this.password));
                 params.append('flag',this.flag);
                var config = {headers: {'X-Requested-With': 'XMLHttpRequest'}};
                    axios.post('./login/login',params,config).then(function(res){
                        if(res.data.code==1){
                          if(_self.flag==true){
                             localStorage.setItem("token",res.data.uid);
                          }
                             sessionStorage.setItem("token",res.data.uid);
                             _self.successInfo= res.data.msg;
                             window.location.href="/home";
                        }
                    })
                }
            }
        }
    })
</script>