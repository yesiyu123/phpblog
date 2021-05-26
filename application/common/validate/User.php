<?php


namespace app\common\validate;

use think\Validate;

class User extends Validate
{
//    protected $rule = [
//        'name|姓名'=>[
//            'require'=>'require',
//            'length'=>'5,20',
//            'chsAlphaNum'=>'chsAlphaNum', // 汉字，字母，数字
//        ],
//        'email|邮箱'=>[
//            'require'=>'require',
//            'email'=>'email',
//            'unique'=>'zh_user', // 字段唯一
//        ],
//        'mobile|手机号'=>[
//            'require'=>'require',
//            'unique'=>'zh_user',
//            'mobile'=>'mobile',
//            'number'=>'number',
//        ],
//        'password|密码'=>[
//            'require'=>'require',
//            'length'=>'6,20',
//            'alphaNum'=>'alphaNum',
//            'confirm'=>'confirm',
//        ],
//    ];
    protected $rule = [
        'name|用户名' => 'require|length:5,20|chsAlphaNum',
        'email|邮箱' => 'require|email|unique:zh_user',
        'mobile|手机号' => 'require|mobile|unique:zh_user',
        'password|密码' => 'require|length:5,20|alphaNum|confirm',
        ];
}