<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/23
 * Time: 11:12
 */

namespace app\admin\service;


class SpiderNewsCategory extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\SpiderNewsCategory;
    }

    /**
     * 设置可更新字段
     * @return array
     */
    public function setAllowField()
    {
        return [
            'parent_id',
            'name',
            'status'
        ];
    }

    /**
     * 更新排序
     * @param $data
     * @return \think\Collection
     */
    public function listOrder($data)
    {
        return $this->model->saveAll($data);
    }
}