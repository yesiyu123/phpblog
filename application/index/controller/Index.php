<?php
namespace app\index\controller;

use app\common\controller\Base;
use app\common\model\Article;
use app\common\model\ArtCate;
use app\common\model\Comment;
use think\facade\Request;
use think\Db;

class Index extends Base
{
    public function index()
    {
        $map = [];
        $map[] = ['status','=',1];
        $keywords = Request::param('keywords'); // get也行

        if (!empty($keywords)){
            $map[] = ['title','like','%'.$keywords.'%'];
        }

        $cateId = Request::param('cate_id');
        if (isset($cateId)){
            $map[] = ['cate_id','=',$cateId];

            $res = ArtCate::get($cateId);

            $artList = Db::table('zh_article')
                ->where($map)
                ->order('create_time', 'desc')
                ->paginate(5);

            $this->view->assign('cateName',$res->name);
        }else{
            $this->view->assign('cateName','全部文章');
            $artList = Db::table('zh_article')
                ->where($map)
                ->order('create_time', 'desc')
                ->paginate(5);

        }

        $this->view->assign('empty','<h3>没有文章</h3>');

        $this->view->assign('artList',$artList);

        return $this->fetch('index',['name'=>'yesiyu']);
    }

    public function insert(){
        $this->isLogin();
        $this->view->assign('title','发布文章');
        $cateList = ArtCate::all();
        if (count($cateList) > 0){
            $this->assign('cateList',$cateList);
        }else{
            $this->error('请先添加栏目','index/index');
        }
        return $this->fetch('insert');
    }

    public function save(){
        if (Request::isPost()){
            $data = Request::post();
//            halt($data);
            $res = $this->validate($data,'app\common\validate\Article');
            if (true !== $res){
                echo '<script>alert("'.$res.'");location.back()</script>';
            }else{
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
                if (Article::create($data)){
                    $this->success('文章发布成功','index/index');
                }else{
                    $this->error('文章保存失败');
                }
            }
        }else{
            $this->error('请求类型错误');
        }
    }

    public function detail(){
        $artId = Request::param('id');
        $art = Article::get(function ($query) use ($artId){
           $query->where('id','=',$artId)->setInc('pv');
        });
        if (!is_null($art)){
            $this->view->assign('art',$art);
        }


        $this->view->assign('commentList',Comment::all(function ($query) use ($artId) {
            $query->where('status',1)
                ->where('art_id',$artId)
                ->order('create_time','desc');
        }));

        $this->view->assign('title','详情页');
        return $this->view->fetch('detail');
    }

    public function fav(){
        if (!Request::isAjax()){
            return json(['status'=>-1,'message'=>'请求类型错误']);
        }

        $data = Request::param();

        if (empty($data['session_id'])){
            return json(['status'=>-2,'message'=>'请先登录！']);
        }

        $map[] = ['user_id','=',$data['user_id']];
        $map[] = ['art_id','=',$data['art_id']];

        $fav = Db::table('zh_user_fav')->where($map)->find();

        if (is_null($fav)){
            Db::table('zh_user_fav')->data([
                'user_id'=>$data['user_id'],
                'art_id'=>$data['art_id'],
            ])->insert();

            return json(['status'=>1,'message'=>'收藏成功']);
        }else{
            Db::table('zh_user_fav')->where($map)->delete();
            return json(['status'=>0,'message'=>'已取消']);
        }
    }

    public function insertComment(){
        $data = Request::param();

        if (Comment::create($data,true)){
            return json(['status'=>1,'message'=>'评论发表成功']);
        }

        return json(['status'=>0,'message'=>'评论发表失败']);
    }
}
