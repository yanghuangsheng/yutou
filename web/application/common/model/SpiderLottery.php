<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/23
 * Time: 10:44
 */

namespace app\common\model;


use think\facade\Request;

class SpiderLottery extends Base
{
    public function getOpenTimeAttr($value)
    {   $timeName = 'Y-m-d H:i:s';
        if(Request::module() == 'api'){
            $timeName = 'Y-m-d';
        }
        return $value ? date($timeName, $value) : '';
    }

    //关联分类
    public function spiderLotteryCategory()
    {
        return $this->belongsTo('SpiderLotteryCategory', 'category_id')->bind(['category_name'=>'name']);
    }
}