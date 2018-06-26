<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>我是表单add</title>
</head>
<body>
    <form method="post" action="/phpdemos/thinkphp/index.php/Home/Form/insert"> 
        标题:<input type="text" name="title"/><br/>
        内容:<input type="text" name="content" /><br/>
        <input type="submit" name="submit" value="提交" />
     </form>

</body>
</html>