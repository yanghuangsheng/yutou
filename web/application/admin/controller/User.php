<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/16
 * Time: 14:08
 */

namespace app\admin\controller;

use \app\admin\logic\User as logic;

class User extends Base
{
    /**
     * 列表
     * @return mixed
     */
    public function index()
    {
        $data = (new logic)->getList();

        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 删除
     * @return mixed
     */
    public function delete()
    {
        return (new logic)->delete();
    }

    /**
     * 更新发布、热门、推荐
     */
    public function update()
    {
        return (new logic)->updateFieldByValue();
    }
}