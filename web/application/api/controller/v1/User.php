<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/13
 * Time: 17:50
 */

namespace app\api\controller\v1;

use \app\api\logic\User as Logic;

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
     * 关注用户
     */
    public function fans()
    {
        return (new Logic)->fans();
    }

    /**
     * 属性
     */
    public function arr()
    {
        return (new Logic)->arr();
    }

    /**
     * 用户信息
     * @return mixed
     */
    public function info()
    {
        return (new Logic)->info();
    }

    /**
     * 绑定手机
     */
    public function bindPhone()
    {
        return (new Logic)->bindPhone();
    }

    /**
     * 我的帖子
     */
    public function collection()
    {
        return (new Logic)->collection();
    }



    /**
     * 处理登陆
     * @return array
     */
    private function saveLogin()
    {
        return (new Logic)->login();
    }
}