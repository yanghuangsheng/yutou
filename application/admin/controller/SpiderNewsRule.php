<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/28
 * Time: 14:13
 */

namespace app\admin\controller;

use app\admin\logic\SpiderNewsRule as SpiderNewsRuleLogic;

class SpiderNewsRule extends Base
{
    /**
     * 采集规则列表
     * @param SpiderNewsRuleLogic $logic
     * @return mixed
     */
    public function index(SpiderNewsRuleLogic $logic)
    {
        $data = (new $logic)->getList();

        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 新增页
     * @param SpiderNewsRuleLogic $logic
     * @return mixed
     */
    public function add(SpiderNewsRuleLogic $logic)
    {
        $data = (new $logic)->getAdd();

        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 编辑页
     * @param SpiderNewsRuleLogic $logic
     * @return mixed
     */
    public function edit(SpiderNewsRuleLogic $logic)
    {
        $data = (new $logic)->getEdit();

        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 删除
     * @param SpiderNewsRuleLogic $logic
     * @return mixed
     */
    public function delete(SpiderNewsRuleLogic $logic)
    {
        return (new $logic)->delete();
    }

}