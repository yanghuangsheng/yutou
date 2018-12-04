<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/23
 * Time: 10:52
 */

namespace app\admin\model;


class SpiderNews extends Base
{
    //关联分类
    public function spiderNewsCategory()
    {
        return $this->belongsTo('SpiderNewsCategory', 'category_id')->bind(['category_name'=>'name']);
    }
}