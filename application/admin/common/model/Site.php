<?php


namespace app\admin\common\model;

use think\Model;

class Site extends Model
{
    protected $pk = 'id';
    protected $table = 'zh_site';
    protected $autoWriteTimestamp = true;

    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y年m月d日';

}