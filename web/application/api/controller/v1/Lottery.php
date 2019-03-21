<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/21
 * Time: 11:07
 */

namespace app\api\controller\v1;


class Lottery extends Base
{
    /**
     * 开奖列表
     */
    public function index()
    {
        $data = (new \app\api\logic\Lottery)->getList();

        return showResult(0, '', $data);
    }

    /**
     * 单个往期记录
     * @return array
     */
    public function oneList()
    {
        $data = (new \app\api\logic\Lottery)->formatOneLotteryList();
        return showResult(0, '', $data);
    }


}