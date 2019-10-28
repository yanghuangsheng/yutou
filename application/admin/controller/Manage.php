<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/22
 * Time: 16:43
 */

namespace app\admin\controller;


class Manage extends Base
{
    /**
     * 后台管理框架页
     */
    public function index()
    {
        $data['user'] = $this->userData;
        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 后台管理首页
     * @return mixed
     */
    public function console()
    {
        return $this->fetch();
    }
}