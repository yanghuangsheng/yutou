<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/24
 * Time: 15:12
 */

namespace app\admin\controller;

use app\admin\logic\UserCapitalLog as logic;

class UserCapitalLog extends Base
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
     * 赠送金币
     * @return mixed
     */
    public function give()
    {
        (new logic)->give();

        return $this->fetch();
    }
}