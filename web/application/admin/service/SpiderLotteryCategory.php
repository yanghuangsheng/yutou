<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/28
 * Time: 10:45
 */

namespace app\admin\service;


class SpiderLotteryCategory extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\admin\model\SpiderLotteryCategory;
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