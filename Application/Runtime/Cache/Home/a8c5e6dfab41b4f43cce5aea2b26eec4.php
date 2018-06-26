<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>编辑表单</title>
</head>
<body>
<form method="post" action="/phpdemos/thinkphp/index.php/Home/Form/update">
  标题:<input type="text" name="title" value="<?php echo ($vo["title"]); ?>" />
  内容:<input type="text"  name="content" value="<?php echo ($vo["content"]); ?>"></textarea>
      <input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>" />
      <input type="submit" value="提交"/>
</form>


</body>
</html>