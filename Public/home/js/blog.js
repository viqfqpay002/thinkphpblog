var blog = new Vue({
  el:"#blog",
  data:{
    items:[],
    flag:false,
    total:1,
    thispage:1
  },
  beforeCreate:function(){
            var _self = this;
      axios.post('./blog/getItem').then(function(res){
          if(res.status==200){
             _self.items = res.data.data;
             _self.total = res.data.total;
             this.flag = false;
          }else {
             this.flag = true;
          }
      })
  },
  methods:{
      pageitem:function(item){
        var _self = this;
        this.thispage = item;
        axios.get('./blog/getItem/p/'+this.thispage).then(function(res){
          if(res.data.data.length>0){
            _self.items = res.data.data;
          }else {
            this.flag = true
          }
        })

      },
      pagePrev: function(){
         var _self = this;
        if(this.thispage>1){
           this.thispage--
        }else {
           this.thispage=1
        }
           axios.get('./blog/getItem/p/'+this.thispage).then(function(res){
          if(res.data.data.length>0){
            _self.items = res.data.data;
          }else {
            this.flag = true
          }
        })
      },
      pageNext: function(){
         var _self = this;
        if(this.thispage<1){
           this.thispage++
        }else {
          this.thispage=this.total
        }
           axios.get('./blog/getItem/p/'+this.thispage).then(function(res){
          if(res.data.data.length>0){
            _self.items = res.data.data;
          }else {
            this.flag = true
          }
        })

      },
     itemHandle:function(item){
      let uid = sessionStorage.getItem('token')?sessionStorage.getItem('token'):localStorage.getItem('token');
       if(uid){
         location.href=encodeURI("./blog/blogdetail?itemid="+item.id+"&title="+item.title+"&content="+item.content+"&imgurl="+item.imgurl+"&tiem="+item.reg_time+"&zan="+item.zan);
       }else {
         window.location.href="/home/login";
       }
     }
  }

});