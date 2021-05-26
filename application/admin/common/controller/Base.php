<?php


namespace app\admin\common\controller;

use think\Controller;
use think\facade\Session;

class Base extends Controller
{
    protected function initialize()
    {

    }

    protected function isLogin(){
        if (!Session::has('admin_id')){
            $this->error('您尚未登录','admin/user/login');
        }
    }

}