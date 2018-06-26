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
      <a href="javascript:;">上一页</a>
        <ul class="ul_box flex" v-for="item in pageSize">
            <li class="item"><a href="javascript:;" @click="pageHandler(item)">{{item}}</a></li>
           <!--  <li class="item"><a href="javascript:;">2</a></li>
            <li class="item"><a href="javascript:;">3</a></li>
            <li class="item"><a href="javascript:;">4</a></li> -->
        </ul>
      <a href="javascript:;">下一页</a>
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
      page:"",
      total:"",
      pageSize:""
    },
    beforeCreate:function(){
       var _self=this;
         axios.get('./Admin/index/fetchAll').then(function(res){
             if(res.data.data.length>0) {
                 _self.items = res.data.data;
                 _self.page = res.data.totleList;
                 _self.total = res.data.pageSize;
                 _self.pageSize = parseInt(_self.page/_self.total);
                 _self.emptyInfo=""
             }
           })
    },
    mounted: function(){
         this.uedit= UE.getEditor('content');
    },
    methods:{
      pageHandler:function(pageid){
        var _self = this;
         axios.get('./Admin/index/fetchAll/p/'+pageid).then(function(res){
             if(res.data.data.length>0){
             _self.items = res.data.data;
             }
         })
      },
     fecthAll: function(){
         var _self=this;
         axios.get('./Admin/index/fetchAll').then(function(res){
             if(res.data.length>0){
                 _self.items = res.data;
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