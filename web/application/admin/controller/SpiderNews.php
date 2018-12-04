<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/23
 * Time: 10:34
 */

namespace app\admin\controller;

use app\admin\logic\SpiderNews as SpiderNewsLogic;

class SpiderNews extends Base
{
    /**
     * 采集规则列表
     * @param SpiderNewsLogic $logic
     * @return mixed
     */
    public function index(SpiderNewsLogic $logic)
    {
        $data = (new $logic)->getList();

        $this->assign('data', $data);
        return $this->fetch();
    }


    /**
     * 删除
     * @param SpiderNewsLogic $logic
     * @return mixed
     */
    public function delete(SpiderNewsLogic $logic)
    {
        return (new $logic)->delete();
    }
}