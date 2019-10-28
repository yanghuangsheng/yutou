<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/10
 * Time: 11:23
 */

namespace app\common\model;


class User extends Base
{
    /**
     * 最近登陆时间
     * @param $value
     * @param $data
     * @return false|string
     */
    protected function getLastLoginTimeAttr($value, $data)
    {
        return $value?date('Y-m-d H:i:s', $value):'';
    }

    /**
     * 头像写入
     * @param $value
     * @param $data
     * @return array|mixed
     */
    protected function setAvatarAttr($value, $data){
        return $value?json_encode($value):'[]';
    }

    /**
     * 头像获取
     * @param $value
     * @param $data
     * @return array|mixed
     */
    protected function getAvatarAttr($value, $data)
    {
        return $value?json_decode($value, true):[];
    }
}