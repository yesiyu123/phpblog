<?php


namespace app\admin\controller;

use app\admin\common\controller\Base;

class Index extends Base
{
    public function index(){
        $this->isLogin();
//        return $this->view->fetch();
        return $this->redirect('user/userList');
    }

}