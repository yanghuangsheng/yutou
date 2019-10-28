<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/4/30
 * Time: 14:52
 */

namespace app\admin\service;


class System extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\System;
    }

    /**
     * 设置可更新字段
     * @return array
     */
    public function setAllowField()
    {
        return true;
    }

    /**
     * 更新DATA
     * @param $data
     * @param $name
     * @return bool
     */
    public function saveData($data, $name)
    {
        if ($this->model->save(['data' => $data], ['name' => $name])) {
            return true;
        }

        return false;
    }
}