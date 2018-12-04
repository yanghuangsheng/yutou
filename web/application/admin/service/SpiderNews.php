<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/30
 * Time: 15:32
 */

namespace app\admin\service;


class SpiderNews extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\admin\model\SpiderNews;
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
     * 关联模形
     * @return $this
     */
    protected function setWithOnView()
    {
        return $this->model->with(['spiderNewsCategory'])->order('id', 'desc');
    }
}