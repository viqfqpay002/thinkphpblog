<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends BaseController
{
    //index渲染
    public function index()
    {
        $c = A(Base);
        $c->staic();
        $c->common();

        $this->display();
    }
    public function addNew()
    {
        $this->index();
    }
    public function addForm(){
      $data['cate'] = $_POST['cate'];
      $data['title'] = $_POST['title'];
      $data['content'] = $_POST['content'];
      $data['reg_time'] = $_POST['time'];
      $imgUrl = $_POST['imgUrl'];
      $form = D('center');
      if($form->create()){
          $forms = $form->add($data);
          if($forms){
             $arr = array("status"=>1,"msg"=>"添加成功!");
             echo json_encode($arr);
          }
      }else{
        exit($form->getError());
      }
    }
//页面打开查询所有列表
    public function fetchAll()
    {
      $model=M('center');
      $count=$model->count();
      $page=new\Think\Page($count,5);//一页显示五条数据
      $show = $page->show();

      $list=$model->limit($page->firstRow,$page->listRows)->select();//
        // $this->assign('list',$list);
        // $this->assign('show',$show);
         // print_r($page);
        // $data = M('center');
        // $forms = $data->field('*')->select();
         $arr = array("data"=>$list,"totleList"=>$page->totalRows,"pageSize"=>$page->listRows);
         echo json_encode($arr);
        
    }

    //删除单项
    public function delItem()
    {
        $id = I('get.id');
        $data = M('center');
        $data->where('id=' . $id)->delete();
    }

    //删除全部
    public function delAll()
    {
        $flag = I('get.flag');
        $data = M('center');
        if ($flag == true) {
            $data->where('1')->delete();
        }
    }

    //筛选条件
    public function selectId()
    {
        $cateId = I('get.cateid');
        $data = M('center');
        $forms = $data->where('cate=' . $cateId)->select();
        echo json_encode($forms);
    }

    //搜索条件
    public function searchVal()
    {
        $content = I('get.searchVal');
        $data = M('center');
        $where['title'] = array('like', '%' . $content . '%');
        $where['content'] = array('like', '%' . $content . '%');
        $where['_logic'] = 'OR';
        if ($content !== "") {
            $forms = $data->where($where)->select();
            echo json_encode($forms);
        } else {
            $this->fetchAll();
        }
    }
    //修改内容
    public function EditForm(){
       $form["id"]= $_POST["id"];
       $form["title"]= $_POST["title"];
       $form["cate"] = $_POST["cate"];
       $form["content"] = $_POST["content"];
       $form["reg_time"] = $_POST["time"];
       $data = M('center');
       if($form!==""){
          $data->where("id=".$form["id"])->save($form);
          $arr = array("status"=>"1","msg"=>"修改成功");
          echo json_encode($arr);
       }else{
        exit($data->getError());
       }
    }

    //图片上传保存到本地文件
    public function upload()
    {
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 3145728;// 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath = "." . PUBLIC_PATH . 'upload/'; // 设置附件上传根目录
        $upload->savePath = ''; // 设置附件上传（子）目录
        // 上传文件
        $info = $upload->upload();
        if ($info) {
            $data = array("imgs"=>[PUBLIC_PATH . 'upload/'.$info['file']['savepath'].$info['file']['savename']]);
            $arr = array('success' => "上传成功", "data" => $data);
            echo json_encode($arr);
            //读取图片
//            $time = date("Y-m-d");
//            $dir = '.' . PUBLIC_PATH . 'upload/' . $time . '/';
//            if (is_dir($dir)) {
//                if ($dh = opendir($dir)) {
//                    while (($file = readdir($dh)) !== false) {
//                        if ($file != "." && $file != "..") {
//                            for ($i = 0; $i < count($file); $i++) {
//                                $data[] = PUBLIC_PATH . 'upload/' . $time . '/' . $file;
//                            }
//                        }
//                    }
//                    $arr = array('success' => "上传成功", "data" => $data);
//                    echo json_encode($arr);
//
//                }
//            };

        }
    }
}