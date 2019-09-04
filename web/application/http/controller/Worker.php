<?php
/**
 * Created by PhpStorm.
 * User: yanghuangsheng
 * Date: 2019-08-02
 * Time: 16:43
 */

namespace app\http\controller;

use think\worker\Server;
use GatewayWorker\Lib\Gateway;

class Worker extends Server
{
    protected $socket = 'websocket://0.0.0.0:2345';

    public function onWorkerStart($worker)
    {

    }

    public function onWorkerReload($worker)
    {

    }

    public function onConnect($connection)
    {
        echo "success";
        //Gateway::sendToAll('onConnect success');
        $connection->send('', 'onConnect success');
    }

    public function onMessage($connection,$data)
    {
        $connection->send(json_encode($data));
    }
}