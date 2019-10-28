<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/13
 * Time: 14:32
 */

namespace app\api\controller\v1;

use think\Controller;

class Base extends Controller
{

    protected function initialize()
    {
        parent::initialize();
        //初始化用户任务
        (new \app\api\logic\Base)->initUserTask();
    }


}