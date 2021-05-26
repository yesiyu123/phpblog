<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

use think\Db;

if (!function_exists('getUserName')){
    function getUserName($id){
        return Db::table('zh_user')->where('id',$id)->value('name');
    }
}

function getArtContent($content){
    return mb_substr(strip_tags($content),0,50).'...';
}

if (!function_exists('getCateName')){
    function getCateName($id){
        return Db::table('zh_article_category')->where('id',$id)->value('name');
    }
}

if (!function_exists('getIsAdmin')){
    function getIsAdmin($id){
        if ($id == 1){
            return "超级管理员";
        }else{
            return "普通会员";
        }
    }
}

function getContentHtml($content){
    return html_entity_decode($content, ENT_QUOTES);
}