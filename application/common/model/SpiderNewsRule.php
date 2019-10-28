<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/28
 * Time: 12:08
 */

namespace app\common\model;


class SpiderNewsRule extends Base
{
    protected $type = [
        'route' => 'array',
        'content' => 'array',
    ];

    //关联分类
    public function spiderNewsCategory()
    {
        return $this->belongsTo('SpiderNewsCategory', 'category_id')->bind(['category_name'=>'name']);
    }
}