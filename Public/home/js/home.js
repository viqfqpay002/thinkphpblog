var home = new Vue({
    el:"#index",
    data:{
        items:[],
        title:"",
        time:"",
        content:"",
        img:[],
        searchText:"",
        selectList:[],
        flag:false,
        blogShow:true,
        msgShow:false,
        aboutShow:false
    },
    beforeCreate:function(){
       axios.post('./home/blog/getItem').then((res=>{
          if(res.data.code==1){
             this.items = res.data.data;
             this.title =this.items[0].title,
             this.time =this.items[0].reg_time,
             this.content =this.items[0].content,
             this.img = this.items[0].imgurl
          }
       }))
    },
    methods:{
        sliderHandle:function(id){
            switch (id) {
                case "blog":
                this.blogShow = true;
                this.msgShow = false;
                this.aboutShow = false;
                    break;
                   case "msg":
                this.blogShow = false;
                this.msgShow = true;
                this.aboutShow = false;
                    break;
                       case "about":
                this.blogShow = false;
                this.msgShow = false;
                this.aboutShow = true;
                    break;
            }
        },
        itemSelect:function(item){
                this.title =item.title,
                this.time = item.reg_time,
                this.content =item.content,
                this.img = item.imgurl
        },
        getTitle:function(){
           axios.get("./home/index/getTitle?searchText="+this.searchText).then((res=>{
              if(res.status==200){
                 this.flag = true;
                 if(res.data.code==1){
                    this.selectList = res.data.list;
                 }
                }else {
                    this.flag=false
                }
           }))
        },
        getItem:function(item){
           this.searchText = item.title;
           this.title = item.title;
           this.content = item.content;
           this.img = item.imgurl;
           this.time = item.reg_time;
           this.flag = false;
        }
    }
})