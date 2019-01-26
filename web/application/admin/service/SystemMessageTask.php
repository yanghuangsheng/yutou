<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/25
 * Time: 15:06
 */

namespace app\admin\service;


class SystemMessageTask extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\SystemMessageTask;
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