<?php


namespace app\index\controller;

use app\common\controller\Base;
use app\common\model\User as UserModel;
use think\facade\Request;
use think\facade\Session;

class User extends Base
{
    public function register(){
        $this->isReg();
        $this->assign('title','用户注册');
        return $this->fetch();
    }
    public function insert(){
        if (Request::isAjax()){
            $data = Request::post();
            $rule = 'app\common\validate\User';
            $res = $this->validate($data,$rule);
            if (true !== $res){
                return json(['status' => -1, 'message' => $res]);
            }else{
//                $data = Request::except('password_confirm', 'post');
                if ($user = UserModel::create($data)){
                    $res = UserModel::get($user->id);
                    Session::set('user_id',$res->id);
                    Session::set('user_name',$res->name);
                    return json(['status' => 1, 'message' => '注册成功']);
                }else{
                    return json(['status' => 0, 'message' => '注册失败']);
                }
            }
        }else{
            $this->error('请求类型错误','register');
        }
    }

    public function login(){
        $this->logined();
        return $this->view->fetch('login',['title' => '用户登录']);
    }

    public function loginCheck(){
        if (Request::isAjax()){
            $data = Request::post();
            $rule = [
                'email|邮箱' => 'require|email',
                'password|密码' => 'require|alphaNum',
            ];
            $res = $this->validate($data,$rule);
            if (true !== $res){
                return json(['status' => -1, 'message' => $res]);
            }else{
                $result = UserModel::get(function ($query) use ($data){
                    $query->where('email', $data['email'])
                    ->where('password', sha1($data['password']));
                });
                if (null == $result){
                    return json(['status' => 0, 'message' => '邮箱或密码不正确']);
                }else{
                    Session::set('user_id', $result->id);
                    Session::set('user_name', $result->name);
                    return json(['status' => 1, 'message' => '登录成功']);
                }
            }
        }else{
            $this->error('请求类型错误','login');
        }
    }

    public function logout(){
//        Session::delete('user_id');
//        Session::delete('user_name');
        Session::clear();
//        Session::destroy(); // 不能用在这里
        $this->success('退出登录成功','index/index');
    }
}