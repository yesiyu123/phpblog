<?php


namespace app\admin\controller;

use app\admin\common\controller\Base;
use app\admin\common\model\User as UserModel;
use think\facade\Request;
use think\facade\Session;

class User extends Base
{
    public function login(){
        $this->view->assign('title','管理员登录');
        return $this->view->fetch('login');
    }

    public function checkLogin(){
        $data = Request::param();

        $map[] = ['email','=',$data['email']];
        $map[] = ['password','=',sha1($data['password'])];

        $result = UserModel::where($map)->find();
        if ($result){
            Session::set('admin_id',$result['id']);
            Session::set('admin_name',$result['name']);
            Session::set('admin_level',$result['is_admin']);
            $this->success('登录成功','admin/user/userList');
        }
        $this->error('登录失败');
    }

    public function logout(){
        Session::clear();
        $this->success('退出成功','admin/user/login');
    }

    public function userList(){
        $data['admin_id'] = Session::get('admin_id');
        $data['admin_level'] = Session::get('admin_level');

        $userList = UserModel::where('id',$data['admin_id'])->select();

        if ($data['admin_level'] == 1){
            $userList = UserModel::select();
        }

        $this->view->assign('title','用户管理');
        $this->view->assign('empty','<span style="color: red">没有任何数据</span>');
        $this->view->assign('userList',$userList);

        return $this->view->fetch('userList');

    }

    public function userEdit(){
        $userId = Request::param('id');

        $userInfo = UserModel::where('id',$userId)->find();

        $this->view->assign('title','编辑用户');
        $this->view->assign('userInfo',$userInfo);

        return $this->view->fetch('useredit');
    }

    public function doEdit(){
        $data = Request::param();

        $id = $data['id'];

        if ($data['password'] == $this->password){
            unset($data['password']);
        }else{
            $data['password'] = sha1($data['password']);
        }

        unset($data['id']);

        if (UserModel::where('id',$id)->data($data)->update()){
            return $this->success('更新成功','userList');
        }

        return $this->error('没有更新成功或失败');
    }

    public function doDelete(){
        $id = Request::param('id');

        if (UserModel::where('id',$id)->delete()){
            return $this->success('删除成功','userList');
        }

        return $this->error('删除失败');
    }

}