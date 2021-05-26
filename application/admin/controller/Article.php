<?php


namespace app\admin\controller;

use app\admin\common\controller\Base;
use app\admin\common\model\Article as ArtModel;
use app\admin\common\model\Cate as CateModel;
use think\facade\Request;
use think\facade\Session;

class Article extends Base
{
    public function index(){
        $this->isLogin();
        return $this->redirect('artList');
    }

    public function artList(){
        $this->isLogin();

        $userId = Session::get('user_id');
        $isAdmin = Session::get('admin_level');

        $artList = ArtModel::where('user_id',$userId)->paginate(3);

        if ($isAdmin == 1){
            $artList = ArtModel::paginate(3);
        }

        $this->view->assign('title','文章管理');
        $this->view->assign('empty','<span style="color: red">没有文章</span>');
        $this->view->assign('artList',$artList);
        return $this->view->fetch('artList');
    }

    public function artEdit(){
        $artId = Request::param('id');

        $artInfo = ArtModel::where('id',$artId)->find();

        $cateList = CateModel::all();

        $this->view->assign('title','编辑文章');
        $this->view->assign('artInfo',$artInfo);
        $this->view->assign('cateList',$cateList);

        return $this->view->fetch('artedit');
    }

    public function doEdit(){
        $data = Request::param();

        $file = Request::file('title_img');
        $info = $file->validate([
            'size'=>1000000,
            'ext'=>'jpeg.,jpg,png,gif',
        ])->move('uploads/');
        if ($info){
            $data['title_img'] = $info->getSaveName();
        }else{
            $this->error($file->getError());
        }
        if (ArtModel::update($data)){
            $this->success('文章更新成功','artList');
        }else{
            $this->error('文章更新失败');
        }
    }

    public function doDelete(){
        $id = Request::param('id');

        if (ArtModel::destroy($id)){
            return $this->success('删除成功');
        }

        return $this->error('删除失败');
    }


}