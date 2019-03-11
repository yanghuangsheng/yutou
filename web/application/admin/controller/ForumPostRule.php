<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/6
 * Time: 17:42
 */

namespace app\admin\controller;

use app\admin\logic\ForumPostRule as logic;

class ForumPostRule extends Base
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
     * 增加
     */
    public function add()
    {
        (new logic)->getAdd();

        return $this->fetch();
    }

    /**
     * 编辑
     */
    public function edit()
    {
        $data = (new logic)->getEdit();

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