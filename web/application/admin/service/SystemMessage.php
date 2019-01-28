<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/28
 * Time: 17:03
 */

namespace app\admin\service;


class SystemMessage extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\SystemMessage;
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

    /**
     * 插入发送用户的信息
     * @param $data
     * @return \think\Collection
     */
    public function saveToMessage($data)
    {
        return $this->model->saveAll($data);
    }
}