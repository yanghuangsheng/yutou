<?php
/**
 * Created by PhpStorm.
 * User: yanghuangsheng
 * Date: 2019-06-27
 * Time: 15:28
 */

namespace app\api\service;


class UserCashLog extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\UserCashLog;
        $this->order = ['id', 'desc'];
    }
}