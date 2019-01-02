<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/5
 * Time: 15:02
 */

namespace app\common\model;


class PortalNews extends Base
{
    /**
     * 发布时间
     * @param $value
     * @param $data
     * @return false|int
     */
    protected function setPublishedTimeAttr($value, $data)
    {
        return $value?strtotime($value):time();
    }
}