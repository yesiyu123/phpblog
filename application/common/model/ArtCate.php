<?php


namespace app\common\model;

use think\Model;


class ArtCate extends Model
{
    protected $pk = 'id';
    protected $table = 'zh_article_category';

    protected $autoWriteTimestamp = true;
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y年m月d日';

    protected $auto = [];

    protected $insert = ['create_time','status'=>1];

    protected $update = ['update_time'];

}