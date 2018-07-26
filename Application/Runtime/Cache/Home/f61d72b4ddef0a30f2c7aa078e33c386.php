<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>登录页面</title>
    <meta name="viewport" width="device-width" content="width=device-width, initial-scale=1">
    <link href="<?php echo ($public_path); ?>home/css/base.css" rel="stylesheet"/>
    <link href="<?php echo ($public_path); ?>home/css/form.css" rel="stylesheet"/>
</head>
<body>
    <?php echo ($ver); ?>
<section class="register form" id="register">
    <div class="form_inner">
        <h3 class="title">注册页面</h3>
        <div class="input_box">
            <input type="text" placeholder="请输入用户名" v-model="username" @input="vegHanlder('username')" :class="{'errInput':userflag}"/>
            <span v-text="usererror" class="errinfo"></span>
        </div>
        <div class="input_box">
            <input type="number" placeholder="请输入11位手机号码"  v-model="phoneNum" @input="vegHanlder('phoneNum')" :class="{'errInput':phoneflag}"/>
            <span v-text="phoneerror" class="errinfo"></span>
        </div>
        <div class="input_box">
            <input type="password" placeholder="请输入至少6位数密码" v-model="password"
            @input="vegHanlder('password')" :class="{'errInput':pasflag}"
            />
             <span v-text="paserror" class="errinfo"></span>
        </div>
         <div class="input_box pas_agin">
            <input type="password" placeholder="请重复输入密码" v-model="angpassword"  @input="vegHanlder('angpassword')" :class="{'errInput':angflag}" />
            <span v-text="agpaserror" class="errinfo"></span>
        </div>
         <div class="ver_box input_box">
            <div  class="input_box flex">
            <input type="text" placeholder="请输入验证码" v-model="vegCode" :class="{'errInput':codeflag}" @input="vegHanlder('vegCode')" @key/>
             <div class="ver_img">
                <img ref="vegImg" src="<?php echo U('/home/register/setVegImg',array());?>" @click="reloadImg()" title="更换验证码"/>
            </div>
        </div>
         <span v-text="vegerror" class="errinfo"></span>
        </div>
         <p class="errinfo" v-text="formFlag" style="color:red"></p>
         <button type="button" class="regSubmitBtn" @click="formSubmit()">注册</button>
         <p>有无注册?<a href="/home/login/">去登录</a></p>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="<?php echo ($public_path); ?>home/js/formdate.js"></script>
<script src="<?php echo ($public_path); ?>home/js/register.js"></script>
</body>
</html>