var reg = new Vue({
    el:"#register",
    data:{
        username:"",
        password:"",
        phoneNum:"",
        angpassword:"",
        vegCode:"",
        userflag:false,
        phoneflag:false,
        pasflag:false,
        angflag:false,
        codeflag:false,
        usererror:"",
        phoneerror:"",
        paserror:"",
        vegerror:"",
        agpaserror:"",
        formFlag:"",
        submitShow:false,
        errinfo:{
             "empty":"该项不能为空",
             "error":"输入不合法,不能包含特殊字符,请重新输入",
            "username":{
                "reg":"^[a-zA-Z0-9_-]{4,16}$",
            },
            "phoneNum":{
                "phoneerror":"请输入11位数手机号",
                "reg":"^1\d{10}$",
            },
            "password":{
                "error":"请输入至少6位字符的密码",
                "aginPasError":"两次输入的密码不一致",
                "reg":"^([A-Z]|[a-z]|[0-9]|[`~!@#$%^&*()+=|{}':;',\\\\[\\\\].<>/?~！@#￥%……&*（）——+|{}【】‘；：”“'。，、？]){6,20}$"
            }
        }
    },
    beforeCreate:function(){
    },
    created:function(){
    },
    methods:{
        reloadImg:function(){
          let vegUrl = "/home/register/setVegImg";
          let time = new Date().getTime();
          this.$refs.vegImg.src = vegUrl+"/"+time;
        },
        // checkVegImg:function(){
        //    var  params = new URLSearchParams();
        //         params.append('vegCode', this.vegCode);
        //    var config = {headers: {'X-Requested-With': 'XMLHttpRequest'}};
        //   axios.get('/home/register/checkVeg',params,config).then((res=>{
        //         if(res.status==200){
        //             return res.data.msg;
        //         }
        //   }))
        // },
        vegHanlder: function(input){
          if(input==="username"){
              let regUser = new RegExp(this.errinfo.username.reg);
             if(this.username==""||this.username==null||this.username=="undefined"){
                 this.usererror=this.errinfo.empty;
                 this.userflag=true;
             }else if(!regUser.test(this.username)){
                 this.usererror=this.errinfo.error;
                 this.userflag=true;
             }else {
                 this.usererror="";
                 this.userflag=false
             }
          }else if(input==="phoneNum"){
              let regPhone = new RegExp(this.errinfo.phoneNum.reg);
             if(this.username==""||this.username==null||this.username=="undefined"){
                 this.usererror=this.errinfo.empty;
                 this.userflag=true;
             }
             if(this.phoneNum.length!==11){
                this.phoneerror = this.errinfo.phoneNum.phoneerror;
                this.phoneflag=true;
             }else if(regPhone.test(this.phoneNum)){
                this.phoneerror = this.errinfo.error;
                this.phoneflag=true;
             }else {
                 this.phoneerror="";
                 this.phoneflag=false
             }

          }else if(input==="password"){
             let regPas = new RegExp(this.errinfo.password.reg);
              if(this.username==""||this.username==null||this.username=="undefined"){
                 this.usererror=this.errinfo.empty;
                 this.userflag=true;
             }
               if(this.phoneNum==""||this.phoneNum==null||this.phoneNum=="undefined"){
                this.phoneerror = this.errinfo.phoneNum.phoneerror;
                this.phoneflag=true;
             }
             if(this.password.length<6){
                 this.paserror = this.errinfo.password.error;
                 this.pasflag=true;
             }else if(!regPas.test(this.password)) {
                 this.paserror = this.errinfo.error;
                 this.pasflag = true;
             }else {
                 this.paserror="";
                 this.pasflag = false
             }
          }else if(input==="angpassword") {
            var agin = this.password;
             if(this.username==""||this.username==null||this.username=="undefined"){
                 this.usererror=this.errinfo.empty;
                 this.userflag=true;
             }
               if(this.phoneNum==""||this.phoneNum==null||this.phoneNum=="undefined"){
                this.phoneerror = this.errinfo.phoneNum.phoneerror;
                this.phoneflag=true;
             }
             if(this.password.length<6){
                 this.paserror = this.errinfo.password.error;
                 this.pasflag=true;
             }
            if(this.angpassword===""||this.angpassword===null||this.angpassword==="undefined"){
                this.agpaserror= this.errinfo.empty;
                this.angflag = true;
            }else if(this.angpassword!==agin){
                this.agpaserror = this.errinfo.password.aginPasError;
                this.angflag = true;
            }else {
                this.agpaserror="";
                this.angflag=false
            }
          }else if(input="vegCode"){
            if(this.vegCode.length<6){
                this.vegerror="请输入6位数验证码";
                this.codeflag=true;
            }else {
                this.vegerror="";
                this.codeflag = false
            }
          }
            },

        formSubmit: function(){
          axios.get('/home/register/checkVeg?vegCode='+this.vegCode).then((res=>{
                if(res.status==200){
                    if(this.userflag!=true&&
            this.codeflag!=true&&
            this.phoneflag!=true&&
            this.pasflag!=true&&
            this.angflag!=true&&res.data.msg==true){
                    this.formFlag="";
               var  params = new URLSearchParams();
                    params.append('username', this.username);
                    params.append('phone',this.phoneNum);
                    params.append('password',window.btoa(this.angpassword));
                    params.append('reg_time',new Date().Format("yyyy-MM-dd hh:mm:ss"));
               var config = {headers: {'X-Requested-With': 'XMLHttpRequest'}};
               axios.post('/home/register/register',params,config).then((res=>{
                     if(res.status=200){
                        this.formFlag = res.data.msg;
                        if(res.data.code==1){
                            window.location.href='/home/login/'
                        }
                     }
               }))
          }else if(res.data.msg==false){
                this.vegerror="请确认验证码";
                this.codeflag=true;
          }else {
               this.formFlag="请确认输入的信息"
          }
                }
          }))
       
        }
    }

})