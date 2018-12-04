<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/30
 * Time: 16:50
 */

namespace app\admin\controller;

use app\admin\logic\SpiderLotteryRule as SpiderLotteryRuleLogic;

class SpiderLotteryRule extends Base
{
    /**
     * 采集规则列表
     * @param SpiderLotteryRuleLogic $logic
     * @return mixed
     */
    public function index(SpiderLotteryRuleLogic $logic)
    {
        $data = (new $logic)->getList();

        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 新增页
     * @param SpiderLotteryRuleLogic $logic
     * @return mixed
     */
    public function add(SpiderLotteryRuleLogic $logic)
    {
        $data = (new $logic)->getAdd();

        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 编辑页
     * @param SpiderLotteryRuleLogic $logic
     * @return mixed
     */
    public function edit(SpiderLotteryRuleLogic $logic)
    {
        $data = (new $logic)->getEdit();

        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 删除
     * @param SpiderLotteryRuleLogic $logic
     * @return mixed
     */
    public function delete(SpiderLotteryRuleLogic $logic)
    {
        return (new $logic)->delete();
    }
}