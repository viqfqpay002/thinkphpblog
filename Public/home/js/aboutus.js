var about = new Vue({
    el:"#about",
    data:{
        items:[],
        total:"",
        list:"",
        thispage:1,
    },
    beforeCreate: function(){
        var _self = this;
        axios.post('./aboutus/getMsgList').then(function(res){
              if(res.status==200){
                _self.items = res.data.data;
                _self.list = res.data.list;
                _self.total =parseInt(Math.ceil(res.data.total/res.data.list));
              }
        })
    },
    methods:{
        pageHanlder: function(index){
            var _self = this;
            this.thispage = index;
            axios.get('./aboutus/getMsgList/p/'+this.thispage).then(function(res){
                _self.items = res.data.data;
            })
        },
        pageTabHanlder: function(index){
            var _self = this;
            if(index<0){
                this.thispage--;
                this.thispage<1?this.thispage:1;
            }else {
                this.thispage++;
                this.thispage>this.total?this.total:this.thispage;
            }
            this.pageHanlder(this.thispage);
        }


    }
})