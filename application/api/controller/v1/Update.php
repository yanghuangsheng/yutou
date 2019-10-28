<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/4/26
 * Time: 14:05
 */

namespace app\api\controller\v1;


class Update extends Base
{
    /**
     * app更新接口
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     */
    public function index()
    {
        (new \app\api\logic\Update)->getUpdate();
    }
}