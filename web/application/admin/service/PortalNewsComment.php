<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/10
 * Time: 10:53
 */

namespace app\admin\service;


class PortalNewsComment extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\PortalNewsComment;
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
        return $this->model->with(['user', 'news'])->order('id', 'desc');
    }
}