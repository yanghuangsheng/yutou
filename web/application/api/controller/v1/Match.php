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
     * @return array
     */
    public function betting()
    {
        return (new MatchLogic)->submitSupport();
    }

    /**
     * 预测记录
     * @return mixed
     */
    public function bettingLog()
    {
        return (new MatchLogic)->supportLog();
    }
}