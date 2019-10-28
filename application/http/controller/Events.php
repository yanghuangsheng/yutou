<?php
/**
 * Created by PhpStorm.
 * User: yanghuangsheng
 * Date: 2019-08-07
 * Time: 10:52
 */

namespace app\http\controller;

use GatewayClient\Gateway;

class Events
{
    public static function onWorkerStart($businessWorker)
    {
        echo "Gatewayworker run \n";
    }

    public static function onConnect($client_id)
    {
        echo "初次链接client_id:" . $client_id . "\n";
    }

    public static function onWebSocketConnect($client_id, $data)
    {
        var_export($data);
        if (!isset($data['get']['token'])) {
//            Gateway::closeClient($client_id);
        }
    }

    public static function onMessage($client_id, $message)
    {
        // 群聊，转发请求给其它所有的客户端
        return GateWay::sendToAll($message);
    }

    public static function onClose($client_id){
//        $logout_message = [
//            'message_type' => 'logout',
//            'id'           => $_SESSION['id']
//        ];
//        Gateway::sendToAll(json_encode($logout_message));
    }

    public static function onWorkerStop($businessWorker)
    {
        echo "WorkerStop" . "\n";
    }
}