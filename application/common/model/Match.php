<?php
/**
 * Created by PhpStorm.
 * User: yanghuangsheng
 * Date: 2019-05-23
 * Time: 11:03
 */

namespace app\common\model;


class Match extends Base
{
    protected $type = [
        'attr_data' => 'array',
    ];

    /**
     * 发布时间
     * @param $value
     * @param $data
     * @return false|int
     */
    protected function setOpenTimeAttr($value, $data)
    {
        return $value?strtotime($value):time();
    }



}