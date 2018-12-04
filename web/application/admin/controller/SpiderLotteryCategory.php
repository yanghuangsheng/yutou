<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/23
 * Time: 10:40
 */

namespace app\admin\controller;

use app\admin\logic\SpiderLotteryCategory as SpiderLotteryCategoryLogic;

class SpiderLotteryCategory extends Base
{
    /**
     * 列表
     * @param SpiderLotteryCategoryLogic $logic
     * @return mixed
     */
    public function index(SpiderLotteryCategoryLogic $logic)
    {
        $data = (new $logic)->getList();

        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 新增
     * @param SpiderLotteryCategoryLogic $logic
     * @return mixed
     */
    public function add(SpiderLotteryCategoryLogic $logic)
    {
        $data = $logic->getAdd();
        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 编辑
     * @param SpiderLotteryCategoryLogic $logic
     * @return mixed
     */
    public function edit(SpiderLotteryCategoryLogic $logic)
    {
        $data = $logic->getEdit();
        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 删除
     * @param SpiderLotteryCategoryLogic $logic
     * @return mixed
     */
    public function delete(SpiderLotteryCategoryLogic $logic)
    {
        return (new $logic)->delete();
    }

    /**
     * 更新排序
     * @param SpiderLotteryCategoryLogic $logic
     * @return mixed
     */
    public function saveListOrders(SpiderLotteryCategoryLogic $logic)
    {
        return (new $logic)->saveListOrders();
    }
}