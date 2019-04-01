<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/28
 * Time: 11:48
 */

namespace app\api\service;


class Sms extends Base
{
    private $url = 'http://api01.monyun.cn:7901/sms/v2/std/';
    private $name = 'E101YG';
    private $pass = 'b57HaF';

    /**
     * 发送短信
     * @param $mobile
     * @param $content
     * @return array|bool
     */
    public function smsSend($mobile, $content)
    {
        $smsService = new \sms\MonYunSend($this->url);

        $data = [
            'userid' => $this->name,
            'pwd' => $this->pass,
            'mobile' => $mobile,
            'content' => $content,
        ];
        try {
            $result = $smsService->singleSend($data);
            if ($result['result'] === 0) {
                return true;
            } else {
                return ['error' =>  "单条信息发送失败，错误码： {$result['result']}"];
            }
        }catch (Exception $e) {
            return ['error' =>  $e->getMessage()];
        }

    }
}