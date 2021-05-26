<?php


namespace app\admin\controller;

use app\admin\common\controller\Base;
use app\admin\common\model\Cate as CateModel;
use think\facade\Request;
use think\facade\Session;

class Cate extends Base
{
    public function index(){
        $this->isLogin();
        return $this->redirect('cateList');
    }

    public function cateList(){
        $this->isLogin();

        $cateList = CateModel::all();

        $this->view->assign('title','分类管理');
        $this->view->assign('empty','<span style="color: red">没有分类</span>');
        $this->view->assign('cateList',$cateList);
        return $this->view->fetch('cateList');
    }

    public function cateEdit(){
        $cateId = Request::param('id');

        $cateInfo = CateModel::where('id',$cateId)->find();

        $this->view->assign('title','编辑分类');
        $this->view->assign('cateInfo',$cateInfo);

        return $this->view->fetch('cateedit');
    }

    public function doEdit(){
        $data = Request::param();

        $id = $data['id'];

        unset($data['id']);

        if (CateModel::where('id',$id)->data($data)->update()){
            return $this->success('更新成功','cateList');
        }

        return $this->error('没有更新成功或失败');
    }

    public function doDelete(){
        $id = Request::param('id');

        if (CateModel::where('id',$id)->delete()){
            return $this->success('删除成功','cateList');
        }

        return $this->error('删除失败');
    }

    public function cateAdd(){

        return $this->view->fetch('cateadd',['title'=>'添加分类']);
    }

    public function doAdd(){
        $data = Request::param();

        if (CateModel::create($data)){
            return $this->success('添加成功','cateList');
        }

        return $this->error('没有添加成功或失败');
    }

}