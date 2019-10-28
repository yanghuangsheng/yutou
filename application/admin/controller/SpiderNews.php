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
     * 新闻列表
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
     * 转发
     * @param SpiderNewsLogic $logic
     * @return mixed
     */
    public function toRelay(SpiderNewsLogic $logic)
    {
        return (new $logic)->toRelay();
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