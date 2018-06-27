var vm = new Vue({
    el:"#login",
    data:{
        username:"",
            password:"",
            flag:false,
            errinfo:""
    },
    methods: {
        verify:function(){

        },
        checked:function(){
           this.flag=!this.flag;
        },
        submit:function(){
            var username = this.username;
            var password = this.password;
            var flag = this.flag;
            var self=this;
            var params = new URLSearchParams();
                 params.append('username', username);
                 params.append('password', password);
                 params.append('flag',flag);
            var config = {headers: {'X-Requested-With': 'XMLHttpRequest'}}
            axios.post('./login/user',params,config).then(function(res){
                if(res.status==200){
                    if(res.data.data.code=="01"){
                        window.location.href="/Admin";
                        sessionStorage.setItem('uid',res.data.data.uid);
                    }else {
                        self.errinfo = res.data.data.msg
                    }
                }
            })
        }
    }
})