<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/10
 * Time: 14:08
 */

namespace app\www\service;


class UserBind extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\UserBind;
    }

    /**
     * 检测是否已绑定过第三方应用登陆
     * @param $map
     * @return float|string
     */
    public function checkBind($map, $type)
    {
        is_array($map) || $map = [['open_id', '=', $map]];

        return $this->model->where($map)->where('type', $type)->count();
    }
}