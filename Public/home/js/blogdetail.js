var detail = new Vue({
    el:"#detail",
    data:{
        title:"",
        imgurl:"",
        content:"",
        id:"",
        regTime:"",
        zan:""
    },
    //渲染详情页
    created:function(){
     let url = decodeURIComponent(location.search);
      var theRequest = new Object();
   if (url.indexOf("?") != -1) {
      var str = url.substr(1);
      strs = str.split("&");
      for(var i = 0; i < strs.length; i ++) {
         theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);
      }
      this.title = theRequest.title;
      this.id = theRequest.id;
      this.content = theRequest.content;
      this.imgurl = theRequest.imgurl;
      this.regTime = theRequest.tiem;
      this.zan = theRequest.zan;
   }
    }
})