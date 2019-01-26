<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/25
 * Time: 16:14
 */

namespace app\admin\service;


class SystemBroadcastTemplate extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\SystemBroadcastTemplate;
        $this->order = ['id', 'desc'];
    }

    /**
     * 设置可更新字段
     * @return array
     */
    public function setAllowField()
    {
        return true;
    }
}