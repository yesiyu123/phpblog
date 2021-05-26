<?php


namespace app\common\controller;

use think\Controller;
use think\facade\Request;
use think\facade\Session;
use app\common\model\ArtCate;
use app\common\model\Article;
use app\admin\common\model\Site;

class Base extends Controller
{
    public function initialize(){
        $this->showNav();

        $this->isOpen();

        $this->getHotArt();
    }

    protected function logined(){
        if (Session::has('user_id')){
            $this->error('您已登录','index/index');
        }
    }

    protected function isLogin(){
        if (!Session::has('user_id')){
            $this->error('您尚未登录','index/index');
        }
    }

    protected function showNav(){
        $cateList = ArtCate::all(function ($query){
            $query->where('status',1)->order('sort','asc');
        });
        $this->view->assign('cateList',$cateList);
    }

    public function isOpen(){
        $isOpen = Site::where('status',1)->value('is_open');

        if ($isOpen == 0 && Request::module() == 'index'){
            $info = <<< 'INFO'
<body style="background-color: #333">
<h1 style="color: #eee; text-align: center;margin: 200px">站点维护中...</h1>
</body>
INFO;

            exit($info);
        }
    }

    public function isReg(){
        $isReg = Site::where('status',1)->value('is_reg');

        if ($isReg == 0){
            $this->error('注册已关闭','index/index');
        }
    }

    public function getHotArt(){
        $hotArtList = Article::where('status',1)->order('pv','desc')->limit(12)->select();

        $this->view->assign('hotArtList',$hotArtList);
    }
}