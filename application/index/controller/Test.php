<?php


namespace app\index\controller;

use app\common\controller\Base;
use app\common\model\User;

class Test extends Base
{
    public function test1(){
//        $data = [
//            'name'=>'admin',
//            'email'=>'aaa@qq.com',
//            'mobile'=>'13545678903',
//            'password'=>'asdf1234',
//        ];
//        $rule = 'app\common\validate\User';
//        return $this->validate($data,$rule);
        dump(User::get(12));
    }
}