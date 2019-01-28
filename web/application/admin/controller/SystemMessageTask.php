<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/25
 * Time: 15:15
 */

namespace app\admin\controller;

use app\admin\logic\SystemMessageTask as logic;

class SystemMessageTask extends Base
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
     * 增加任务
     * @return mixed
     */
    public function add()
    {
        (new logic)->getAdd();

        return $this->fetch();
    }

    /**
     * 删除任务
     * @return mixed
     */
    public function delete()
    {
        return (new logic)->delete();
    }
}