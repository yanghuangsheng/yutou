<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/7
 * Time: 16:46
 */

namespace app\www\service;


class ForumPostContent extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\ForumPostContent;
    }
}