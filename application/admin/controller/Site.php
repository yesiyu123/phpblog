<?php


namespace app\admin\controller;

use app\admin\common\controller\Base;
use app\admin\common\model\Site as SiteModel;
use think\facade\Request;
use think\facade\Session;

class Site extends Base
{

    public function index(){
//        $siteInfo = SiteModel::get(['status'=>1]);
//        $siteInfo = SiteModel::all();

        if (null != SiteModel::get(['status'=>1])){
            $siteInfo = SiteModel::get(['status'=>1]);
        }else{
            $siteInfo = SiteModel::get(['status'=>0]);
        }

        $this->view->assign('siteInfo',$siteInfo);

        return $this->view->fetch('index');
    }

    public function save(){
        $data = Request::param();

        if (SiteModel::update($data)){
            $this->success('更新成功','index');
        }
        $this->error('更新失败','index');
    }

}