<?php if (!defined('THINK_PATH')) exit();?><link href="<?php echo ($public_path); ?>admin/css/add.css" rel="stylesheet"/>
<div class="add_form" id="add">
    <h1 class="title">新增文章</h1>
    <div class="form">
        <div class="input_box">
            <label>选择分类</label>
            <select v-model = "selectVal" >
                <option value="">请选择</option>
                <option value="1">博文</option>
                <option value="2">分类</option>
            </select>
        </div>
        <div class="input_box">
           <label>标题</label>
            <input type="text" placeholder="请输入新增的文章标题"  v-model="title"/>
        </div>
        <div class="input_box">
            <label >文章图片</label>
            <input type="file" @change="getImg" />
            <div class="img_load_show">
                <ul class="ul_box">
                  <li class="item" v-for="(item,index) in imgs" >
                      <span class="icon icon-close" @click="loadremove(index)">X</span>
                      <img :src="item" :alt="index" @click="imgtrue(item)"/>
                  </li>
                </ul>
            </div>
        </div>
        <div class="input_box cotnentBox">
            <label>文章内容</label>
            <textarea name="content" class="content" id="content"></textarea>
        </div>
        <div class="input_box">
            <input type="button" class="btn submit" value="提交" @click="getformval()">
        </div>
    </div>
    <div class="markBox" v-show="mark==true" @click="markClose()">
        <div class="markInner">
           <img :src="imgSrc" alt="img"/>
        </div>
    </div>
</div>
<script src="<?php echo ($public_path); ?>admin/util/UEditor/ueditor.config.js"></script>
<script src="<?php echo ($public_path); ?>admin/util/UEditor/ueditor.all.js"></script>
<script src="<?php echo ($public_path); ?>admin/util/UEditor/lang/zh-cn/zh-cn.js"></script>
<script src="<?php echo ($public_path); ?>admin/js/FormDate.js"></script>
<script>
    var vm = new Vue({
       el:"#add",
        data:{
           imgs:[],
           imgData: {
                accept: 'image/gif, image/jpeg, image/png, image/jpg'
            },
            imgSrc:"",
            mark:false,
            selectVal:"",
            title:"",
            uedit:""
        },
        mounted:function(){
           this.uedit= UE.getEditor('content');
        },
        methods: {
            getImg: function (event) {
                var _self = this;
                var reader = new FileReader();
                var img1 = event.target.files[0];
                var type = img1.type;//文件的类型，判断是否是图片
                var size = img1.size;//文件的大小，判断图片的大小
                var length = 1;
                if (this.imgData.accept.indexOf(type) == -1) {
                    alert('请选择我们支持的图片格式！');
                    return false;
                }
                if (size > 3145728) {
                    alert('请选择3M以内的图片！');
                    return false;
                }
                    var form = new FormData();
                    form.append('file', img1, img1.name);
                    axios.post('./upload', form, {
                        headers: {'Content-Type': 'multipart/form-data'}
                    }).then(function (res) {
                        if(_self.imgs.length>=4){
                            return false
                        }else {
                            _self.imgs .push( res.data.data.imgs);
                        }
                    });
            },
            loadremove:function(index){
                 this.imgs.pop(index)
            },
            imgtrue: function(img){
                this.mark=true;
                this.imgSrc = img[0];
            },
            markClose: function(){
                this.mark=false;
                this.imgSrc="";
            },
            getformval: function(){
              var params = new URLSearchParams();
                 params.append('cate', this.selectVal);
                 params.append('title', this.title);
                 params.append('content',this.uedit.getContent());
                 params.append('imgUrl',this.imgs);
                 params.append('time',new Date().Format("yyyy-MM-dd hh:mm:ss"));
            var config = {headers: {'X-Requested-With': 'XMLHttpRequest'}};
                 axios.post('./addForm',params,config).then(function(res){
                    if(res.data.status==1){
                        alert(res.data.msg);
                        window.location.href="/Admin";
                    }
                 })

            }
        }
    });
</script>