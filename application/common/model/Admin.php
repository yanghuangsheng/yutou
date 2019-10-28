<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/22
 * Time: 15:33
 */

namespace app\common\model;


class Admin extends Base
{
    public function getLoginLastTimeAttr($value)
    {
        return $value ? date('Y-m-d H:i:s', $value) : '';
    }

    public function setUserPasswordAttr($value)
    {
        return $value ? md5Encryption($value) : '';
    }
}