<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/13
 * Time: 17:50
 */

namespace app\api\controller\v1;


class User extends Base
{
    /**
     * 登陆
     * @return mixed
     */
    public function login()
    {
        return $this->saveLogin();
    }

    /**
     * 注册
     * @return mixed
     */
    public function register()
    {
        return $this->saveLogin();
    }

    /**
     * 发送验证
     */
    public function sendSms()
    {
        $sms = new \app\api\logic\Sms;

        return $sms->send();

    }

    /**
     * 处理登陆
     * @return array
     */
    private function saveLogin()
    {
        return (new \app\api\logic\User)->login();
    }

}