<?php
  namespace Admin\Model;
  use Think\Model;

  class FormModel extends Model{
    protected $_validate = array{
        array("title",'require','标题必须');
        array("content",'require','文章内容必须');
    }
  }

?>