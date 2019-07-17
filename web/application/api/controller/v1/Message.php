<?php
/**
 * Created by PhpStorm.
 * User: yanghuangsheng
 * Date: 2019-06-06
 * Time: 14:41
 */

namespace app\api\controller\v1;

use app\api\logic\Message as MessageLogic;

class Message extends Base
{
    /**
     * 消息内容
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     */
    public function index()
    {
        (new MessageLogic)->allList();
    }

    /**
     * 更多消息
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     */
    public function moreList()
    {
        (new MessageLogic)->pageList();
    }
}