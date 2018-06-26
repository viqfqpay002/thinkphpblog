<?php if (!defined('THINK_PATH')) exit();?><link href="<?php echo ($public_path); ?>admin/css/index.css" rel="stylesheet"/>
<article class="content" id="center">
  <div class="c_header flex">
     <div class="select_box">
         <label>分类</label>
         <select v-model="selectedVal" @change="selectHandle()">
              <option value="">请选择</option>
              <option value="1">博文</option>
              <option value="2">分类</option>
         </select>
     </div>
     <div class="search_box">
         <div class="input_box">
             <input type="text" placeholder="请输入搜索内容" v-model="searchVal"/>
             <a href="javascript:;" @click="searchHandle()">搜索</a>
         </div>
     </div>
      <div class="header_btns">
         <button type="button" @click="delhandleAll()" >删除全部</button>
      </div>
  </div>
  <table style="text-align: center;">
      <tr>
         <th width="10%" @click="checkedAll()">全选</th>
         <th width="10%">id</th>
         <th width="30%">文章标题</th>
         <th width="30%">文章内容</th>
         <th width="10%">发布日期</th>
         <th width="30%">操作</th>
      </tr>
      <tr v-for="(item,index) in items" :key="index">
          <td><input type="checkbox" name="flag"  class="checked" :checked = "allFlag"/></td>
          <td>{{item.id}}</td>
          <td>{{item.title}}</td>
          <td>{{item.content}}</td>
          <td>{{item.reg_time}}</td>
          <td>
               <button type="button" @click="edithandle(item.id)">编辑</button>
               <button type="button" @click="delhandle(item.id)">删除</button>
          </td>
      </tr>

  </table>
  <span >{{emptyInfo}}</span>
  <div class="paging flex">
      <a href="javascript:;" @click="pageprev()">上一页</a>
        <ul class="ul_box flex" >
            <li class="item" v-for="item in pageSize">
                <a href="javascript:;" @click="pageHandler(item)" :class="{'active':start==item}" >{{item}}</a>
            </li>
        </ul>
      <a href="javascript:;" @click="pagenext()">下一页</a>
  </div>
  <div class="markBox" v-show="mark==true">
    <div class="edit_forms">
       <div class="input_box">
         <span>修改分类</span>
         <select v-model="newselectVal">
              <option value="1">博文</option>
              <option value="2">咨讯</option>
         </select>
       </div>
       <div class="input_box">
         <span>修改标题</span>
         <input type="text" v-model="newTitle"/>
       </div>
       <div class="input_box">
          <span>修改内容</span>
          <textarea name="content" id="content"></textarea>
       </div>
       <div class="input_box btns">
          <input type="button" classs="btn submit" value="确认修改" @click = "submitEdit()"/>
          <input type="button" class="btn close" value="关闭" @click="closeMark()"/>
       </div>
    </div>
  </div>
</article>
<script src="<?php echo ($public_path); ?>admin/util/UEditor/ueditor.config.js"></script>
<script src="<?php echo ($public_path); ?>admin/util/UEditor/ueditor.all.js"></script>
<script src="<?php echo ($public_path); ?>admin/util/UEditor/lang/zh-cn/zh-cn.js"></script>
<script src="<?php echo ($public_path); ?>admin/js/FormDate.js"></script>
<script>
   new Vue({
    el:"#center",
    data:{
      items:[],
      selectText:[],
      val:[],
      searchVal:"",
      selectedVal:"",
      allFlag:false,
      emptyInfo:"暂无数据",
      mark:false,
      newselectVal:"",
      newTitle:"",
      uedit:"",
      editId:"",
      page:"",//合计总条数
      total:"", //每页显示条数
      pageSize:"", //总页数
      start:1//记录当前页码
    },
       //页面初始化渲染
    beforeCreate:function(){
       var _self=this;
         axios.get('./Admin/index/fetchAll').then(function(res){
             if(res.data.data.length>0) {
                 _self.items = res.data.data;
                 _self.page = res.data.totleList;
                 _self.total = res.data.pageSize;
                 _self.pageSize = res.data.pagetotal;
                 _self.emptyInfo=""
             }
           })
    },
    mounted: function(){
        //实例化ueditor
         this.uedit= UE.getEditor('content');
    },
    methods:{
        //分页操作
      pageHandler:function(pageid){
        var _self = this;
         axios.get('./Admin/index/fetchAll/p/'+pageid).then(function(res){
             if(res.data.data.length>0){
             _self.items = res.data.data;
              _self.start = pageid;
             }
         })
      },
        pageprev:function(){
            if(this.start>1){
                this.start--;
                var _self = this;
                axios.get('./Admin/index/fetchAll/p/'+this.start).then(function(res){
                    if(res.data.data.length>0){
                        _self.items = res.data.data;
                    }
                })
            }else {
                this.start=1;
            }
        },
        pagenext:function(){
            if(this.start<this.pageSize){
                this.start++;
                var _self = this;
                axios.get('./Admin/index/fetchAll/p/'+this.start).then(function(res){
                    if(res.data.data.length>0){
                        _self.items = res.data.data;
                    }
                })
            }else {
                this.start=this.pageSize
            }
        },
        //查询所有数据
     fecthAll: function(){
         var _self=this;
         axios.get('./Admin/index/fetchAll').then(function(res){
             if(res.data.data.length>0) {
                 _self.items = res.data.data;
                 _self.page = res.data.totleList;
                 _self.total = res.data.pageSize;
                 _self.pageSize = res.data.pagetotal;
                 _self.emptyInfo=""
             }
         })
        },
      delhandle: function(id){
            var config = {headers: {'X-Requested-With': 'XMLHttpRequest'}}
               var f = confirm("确定删除此项吗？");
               if(f==true){
                   axios.get('./Admin/index/delItem?id='+id,config).then(function(res){
                       window.location.reload();
                   })
               }
            },
        checkedAll:function(){
            this.allFlag =!this.allFlag;
        },
        delhandleAll:function(){
           if(this.allFlag==true){
               axios.get('./Admin/index/delAll?flag='+ this.allFlag).then(function(res){
                   window.location.reload();
               })
           }
        },
       searchHandle:function(){
           var config = {headers: {'X-Requested-With': 'XMLHttpRequest'}};
           var val = this.searchVal;
           var _self = this;
           if(val!=""){
               axios.get('./Admin/index/searchVal?searchVal='+val,config).then(function(res){
                   _self.items = res.data;
               })
           }else {
                  _self.fecthAll();
           }

       },
       selectHandle:function(){
           var config = {headers: {'X-Requested-With': 'XMLHttpRequest'}};
           var cateVal = this.selectedVal;
           var _self = this;
           if(cateVal>0){
               axios.get('./Admin/index/selectId?cateid='+cateVal,config).then(function(res){
                _self.items = res.data;
           })
           }else {
             _self.fecthAll();
           }
         },
         
       edithandle : function(item){
            var _self = this;
           this.mark=true;
           this.items.forEach(function(list,index){
             if(item==list.id){
                _self.editId = list.id;
                _self.newTitle = list.title;
                _self.newselectVal = list.cate;
                _self.uedit.setContent(list.content) ;
              }
           })
       },

       submitEdit: function(){
           var params = new URLSearchParams();
                 params.append('id', this.editId);
                 params.append('title', this.newTitle);
                 params.append('cate',this.newselectVal);
                 params.append('content',this.uedit.getContent());
                 params.append('time',new Date().Format("yyyy-MM-dd hh:mm:ss"));
            var config = {headers: {'X-Requested-With': 'XMLHttpRequest'}};
            axios.post('./Admin/index/EditForm',params,config).then(function(res){
                  if(res.data.status==1){
                     alert("修改成功");
                     this.mark = false;
                     window.location.reload()
                  }
            })
       },
       closeMark:function(){
         this.mark = false
       }
       }
      })
</script>