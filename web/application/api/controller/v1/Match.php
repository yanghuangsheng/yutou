<?php
/**
 * Created by PhpStorm.
 * User: yanghuangsheng
 * Date: 2019-05-29
 * Time: 16:23
 */

namespace app\api\controller\v1;

use app\api\logic\Match as MatchLogic;

class Match extends Base
{
    /**
     * 竞猜预测
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function betting()
    {
        (new MatchLogic)->submitSupport();
    }

    /**
     * 预测记录
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     */
    public function bettingLog()
    {
        (new MatchLogic)->supportLog();
    }
}