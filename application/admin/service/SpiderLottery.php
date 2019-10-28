<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/30
 * Time: 17:42
 */

namespace app\admin\service;


class SpiderLottery extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\SpiderLottery;
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
        return $this->model->with(['spiderLotteryCategory'])->order('id', 'desc');
    }
}