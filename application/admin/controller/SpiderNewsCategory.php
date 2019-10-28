<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/23
 * Time: 10:37
 */

namespace app\admin\controller;

use app\admin\logic\SpiderNewsCategory as SpiderNewsCategoryLogic;

class SpiderNewsCategory extends Base
{
    /**
     * 列表
     * @param SpiderNewsCategoryLogic $logic
     * @return mixed
     */
    public function index(SpiderNewsCategoryLogic $logic)
    {
        $data = (new $logic)->getList();

        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 新增
     * @param SpiderNewsCategoryLogic $logic
     * @return mixed
     */
    public function add(SpiderNewsCategoryLogic $logic)
    {
        $data = $logic->getAdd();
        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 编辑
     * @param SpiderNewsCategoryLogic $logic
     * @return mixed
     */
    public function edit(SpiderNewsCategoryLogic $logic)
    {
        $data = $logic->getEdit();
        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 删除
     * @param SpiderNewsCategoryLogic $logic
     * @return mixed
     */
    public function delete(SpiderNewsCategoryLogic $logic)
    {
        return (new $logic)->delete();
    }

    /**
     * 更新排序
     * @param SpiderNewsCategoryLogic $logic
     * @return mixed
     */
    public function saveListOrders(SpiderNewsCategoryLogic $logic)
    {
        return (new $logic)->saveListOrders();
    }
}