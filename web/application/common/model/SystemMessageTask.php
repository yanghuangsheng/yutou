<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/25
 * Time: 15:08
 */

namespace app\common\model;


class SystemMessageTask extends Base
{
    /**
     * 推送时间
     * @param $value
     * @param $data
     * @return false|string
     */
    protected function getSendTimeAttr($value, $data)
    {
        return $value?date('Y-m-d H:i:s', $value):'';
    }

    protected function setSendTimeAttr($value, $data)
    {
        return $value?strtotime($value):0;
    }
}