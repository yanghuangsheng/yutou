<?php
/**
 * Created by PhpStorm.
 * User: yanghuangsheng
 * Date: 2019-05-29
 * Time: 15:02
 */

namespace app\api\service;


class Match extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\Match;
        $this->order = ['id', 'desc'];
    }
}