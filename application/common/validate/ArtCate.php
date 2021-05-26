<?php


namespace app\common\validate;

use think\Validate;


class ArtCate extends Validate
{
    protected $rule = [
        'name|标题' => 'require|length:3,20|chsAlphaNum',
    ];

}