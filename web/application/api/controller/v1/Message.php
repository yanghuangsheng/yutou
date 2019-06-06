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
     * @return array
     * @throws \app\api\exception\ApiException
     */
    public function index()
    {
        return (new MessageLogic)->allList();
    }

    /**
     * 更多消息
     * @return array
     * @throws \app\api\exception\ApiException
     */
    public function moreList()
    {
        return (new MessageLogic)->pageList();
    }
}