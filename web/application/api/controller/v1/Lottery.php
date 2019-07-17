<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/21
 * Time: 11:07
 */

namespace app\api\controller\v1;

use \app\api\logic\Lottery as LotteryLogic;

class Lottery extends Base
{
    /**
     * 开奖列表
     * @throws \app\api\exception\SuccessException
     */
    public function index()
    {
        (new LotteryLogic)->getList();

    }

    /**
     * 单个往期记录
     * @throws \app\api\exception\SuccessException
     */
    public function oneList()
    {
        (new LotteryLogic)->formatOneLotteryList();
    }


}