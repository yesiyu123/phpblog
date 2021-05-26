<?php


namespace app\common\model;

use think\Model;


class Comment extends Model
{
    protected $pk = 'id';
    protected $table = 'zh_user_comments';

    protected $autoWriteTimestamp = true;
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y年m月d日';
}