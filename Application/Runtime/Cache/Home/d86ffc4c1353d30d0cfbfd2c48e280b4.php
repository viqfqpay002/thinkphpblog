<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title> 读取数据</title>
</head>
<body>
   <table>
     <tr>
        <th>id</th>
        <th>标题</th>
        <th>内容</th>
     </tr>
     <tr>
       <td><?php echo ($data["id"]); ?></td>
       <td><?php echo ($data["title"]); ?></td>
       <td><?php echo ($data["content"]); ?></td>
     </tr>
   </table>
</body>
</html>