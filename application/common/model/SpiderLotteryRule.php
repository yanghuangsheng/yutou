<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/30
 * Time: 16:50
 */

namespace app\common\model;


class SpiderLotteryRule extends Base
{
    protected $type = [
        'route' => 'array',
        'content' => 'array',
    ];

    //关联分类
    public function SpiderLotteryCategory()
    {
        return $this->belongsTo('SpiderLotteryCategory', 'category_id')->bind(['category_name'=>'name']);
    }
}