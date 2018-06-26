<?php if (!defined('THINK_PATH')) exit();?><div class="add_form">
    <div class="form">
        <div class="input_box">
            <label>选择分类</label>
            <select v-model="selectedVal" @change="selectHandle()">
                <option value="">请选择</option>
                <option value="1">博文</option>
                <option value="2">分类</option>
            </select>
        </div>
        <div class="input_box">
           <label>标题</label>
            <input type="text" placeholder="请输入新增的文章标题"/>
        </div>
        <div class="input_box">
            <label >文章图片</label>
            <input type="file">
            <div class="img_load_show">
                <ul class="ul_box">
                    <li class="item"></li>
                    <li class="item"></li>
                    <li class="item"></li>
                    <li class="item"></li>
                </ul>
            </div>
        </div>
        <div class="input_box">
            <label>文章内容</label>
            <textarea name="content" class="content"></textarea>
        </div>
    </div>
</div>