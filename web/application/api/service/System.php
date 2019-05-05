<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/5/5
 * Time: 11:44
 */

namespace app\api\service;


class System extends common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\System;
        $this->order = ['id', 'desc'];
    }

    /**
     * 获取版本更新信息
     */
    public function getVersionData()
    {
        return $this->getField([['name', '=', 'version']], 'data');
    }
}