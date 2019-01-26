<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/25
 * Time: 16:18
 */

namespace app\admin\controller;

use app\admin\logic\SystemBroadcastTemplate as logic;

class SystemBroadcastTemplate extends Base
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
}