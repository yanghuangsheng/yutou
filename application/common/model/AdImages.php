<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/15
 * Time: 10:33
 */

namespace app\common\model;


class AdImages extends Base
{
    protected function setPutOpenTimeAttr($value, $data)
    {
        return $value?strtotime($value):0;
    }

    protected function setPutEndTimeAttr($value, $data)
    {
        return $value?strtotime($value):0;
    }

    protected function getPutOpenTimeAttr($value, $data)
    {
        return $value?date('Y-m-d H:i:s',$value):'';
    }

    protected function getPutEndTimeAttr($value, $data)
    {
        return $value?date('Y-m-d H:i:s',$value):'';
    }
}