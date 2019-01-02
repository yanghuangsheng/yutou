<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/23
 * Time: 10:38
 */

namespace app\admin\controller;

use app\admin\logic\SpiderLottery as SpiderLotteryLogic;

class SpiderLottery extends Base
{
    /**
     * 彩票列表
     * @param SpiderLotteryLogic $logic
     * @return mixed
     */
    public function index(SpiderLotteryLogic $logic)
    {
        $data = (new $logic)->getList();

        $this->assign('data', $data);
        return $this->fetch();
    }


    /**
     * 删除
     * @param SpiderLotteryLogic $logic
     * @return mixed
     */
    public function delete(SpiderLotteryLogic $logic)
    {
        return (new $logic)->delete();
    }
}