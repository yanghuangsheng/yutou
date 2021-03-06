<?php
/**
 * Created by PhpStorm.
 * User: yanghuangsheng
 * Date: 2019-06-06
 * Time: 15:01
 */

namespace app\api\logic;

use app\api\service\SystemMessage as SystemMessageService;
use app\api\exception\SuccessException;

class Message extends Base
{
    /**
     * 获取消息列表
     * @throws SuccessException
     * @throws \app\api\exception\ErrorException
     */
    public function allList()
    {
        $this->checkToken();
        $userId = $this->tokenData['id'];

        $messageService = new SystemMessageService;

        $data['message'][0] = $this->commonList($messageService, [['user_id', '=', $userId], ['type', '=', 0]], 1);
        $data['message'][1] = $this->commonList($messageService, [['user_id', '=', $userId], ['type', '=', 1]], 1);

        $data['start_id'] = $messageService->newsId();

        throw new SuccessException('success', $data);
    }

    /**
     * 获取指定分页消息
     * @throws SuccessException
     * @throws \app\api\exception\ErrorException
     */
    public function pageList()
    {
        $this->checkToken();
        $param = $this->param();
        $userId = $this->tokenData['id'];

        $where = [
            ['user_id', '=', $userId],
            ['type', '=', $param['type']]
        ];
        $page = isset($param['page'])?$param['page']:1;

        $messageService = new SystemMessageService;

        $data = $this->commonList($messageService, $where, $page);

        throw new SuccessException('success', $data);
    }

    /**
     * 公共消息列表
     * @param $service
     * @param $where
     * @param int $page
     * @return mixed
     */
    protected function commonList($service, $where, $page = 1)
    {
        $data = $service
            ->initWhere($where)
            ->initLimit($page)
            ->getListData();

        //$domain = $this->getDomain();
        $data['list'] = $data['list']->toArray();
        return $data['list'];
    }
}