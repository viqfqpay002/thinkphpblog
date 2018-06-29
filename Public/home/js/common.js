  var header = new Vue({
      el:"#header",
      data:{
          user:"",
          aboutus:false,
          blog:false,
          home:false,
          itemShow:false,
      },
      beforeMount:function(){
          this.itemActive();
              let  _self = this;
              let  getUid = sessionStorage.getItem('token');
              let uid =getUid?getUid:localStorage.getItem('token');
          if(uid){
             var params = new URLSearchParams();
                 params.append('uid',uid);
              var config = {headers: {'X-Requested-With': 'XMLHttpRequest'}};
              axios.post('/home/index/getuid',params,config).then(function(res){
                  if(res.status==200&&res.data.code==1){
                      _self.user = res.data.username;
                      _self.itemShow=true;
              }
          })
            }
          },
      methods:{
         itemActive: function(){
             let url = window.location.pathname;
             let urlStr =  url.split("/");
             if(url==""){
               this.aboutus=false;
               this.home= true;
               this.blog = false;
             }
             for(let i=0;i<urlStr.length;i++){
               if(urlStr[2]=="aboutus"){
             this.blog = false;
             this.home=false;
             this.aboutus = true;
          }else if(urlStr[2]=="blog"){
             this.aboutus=false;
             this.home= false;
             this.blog = true;
          }else{
              this.aboutus=false;
              this.home= true;
              this.blog = false;
          }

             }
           },
          logout: function(){
              sessionStorage.clear();
              localStorage.clear();
             window.location.href="/home"
          }
      }
  });
  var footer = new Vue({
      el:"#footer",
      data:{
          name:"",
          email:"",
          msg:"",
          errinfo:"",
          mark:false,
      },
      mounted:function(){
          this.mark = false
      },
      methods:{
          submitHandler: function(){
              let  _self = this;
              let  getUid = sessionStorage.getItem('token');
              let uid =getUid?getUid:localStorage.getItem('token');
          if(!uid){
              window.location.href="/home/login";
          }else{
             var params = new URLSearchParams();
                 params.append('uid',uid);
              var config = {headers: {'X-Requested-With': 'XMLHttpRequest'}};
              axios.post('/home/index/getuid',params,config).then(function(res){
                  if(res.status==200&&res.data.code==1){
                      _self.user = res.data.username;
                      _self.itemShow=true;

                      if(_self.username!=""&&_self.msg!=""&&_self.email!=""){
                       _self.errinfo="";
                       var params = new URLSearchParams();
                       params.append('name', _self.name);
                       params.append('email', _self.email);
                       params.append('msg',_self.msg);
                       params.append('time',new Date().Format("yyyy-MM-dd hh:mm:ss"))
                       var config = {headers: {'X-Requested-With': 'XMLHttpRequest'}};
                       axios.post('/home/index/setMsg',params,config).then(function(res){
                        _self.mark = true;
                        setTimeout(function(){
                          _self.mark = false;
                          _self.username="";
                          _self.msg="";
                          _self.email="";
                        },300);
                      })
                     }else{
                      _self.errinfo="请确认填写的信息,均不能为空"
                    }
                  }
              });
          };
          }
      }
  })