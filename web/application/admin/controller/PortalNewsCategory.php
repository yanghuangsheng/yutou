<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/5
 * Time: 14:22
 */

namespace app\admin\controller;

use app\admin\logic\PortalNewsCategory as PortalNewsCategoryLogic;

class PortalNewsCategory extends Base
{
    /**
     * 列表
     * @param PortalNewsCategoryLogic $logic
     * @return mixed
     */
    public function index(PortalNewsCategoryLogic $logic)
    {
        $data = (new $logic)->getList();

        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 新增
     * @param PortalNewsCategoryLogic $logic
     * @return mixed
     */
    public function add(PortalNewsCategoryLogic $logic)
    {
        $data = $logic->getAdd();
        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 编辑
     * @param PortalNewsCategoryLogic $logic
     * @return mixed
     */
    public function edit(PortalNewsCategoryLogic $logic)
    {
        $data = $logic->getEdit();
        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 删除
     * @param PortalNewsCategoryLogic $logic
     * @return mixed
     */
    public function delete(PortalNewsCategoryLogic $logic)
    {
        return (new $logic)->delete();
    }

    /**
     * 更新排序
     * @param PortalNewsCategoryLogic $logic
     * @return mixed
     */
    public function saveListOrders(PortalNewsCategoryLogic $logic)
    {
        return (new $logic)->saveListOrders();
    }
}