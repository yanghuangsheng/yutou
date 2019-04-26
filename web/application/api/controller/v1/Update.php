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
    public function index()
    {
        return (new \app\api\logic\Update)->getUpdate();
    }
}