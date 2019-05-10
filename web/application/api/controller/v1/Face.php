<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/5/10
 * Time: 15:33
 */

namespace app\api\controller\v1;

use \app\api\logic\Face as FaceLogic;

class Face extends Base
{
    /**
     * 获取所有表情包
     */
    public function index()
    {
        return (new FaceLogic)->getList();
    }
}