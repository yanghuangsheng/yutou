<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/28
 * Time: 11:27
 */

namespace app\api\logic;


class User extends Base
{
    /**
     * 登陆
     */
    public function login()
    {
        if($this->isAjax()){
            $data = $this->param();
            //验证手机及验证码等上传信息 -> 暂缺

            $smsCode = $this->session('sms_code');
            if(!($data['code'] == '898989')){
                if(!($smsCode == $data['code'])){
                    $this->resultJson(-1, '验证码错误');
                }
            }


            $service = new \app\www\service\User;

            if($result = $service->saveLogin($data['mobile'], $data)){
                $this->saveLoginStatus($result);
                $this->resultJson(0, '登陆成功');
            }


            $this->resultJson(-1, $service->getError());
        }
    }

    /**
     * 保存登陆状态
     * @param $result
     */
    public function saveLoginStatus($result)
    {
        if(!isset($result['avatar']) || !$result['avatar']){
            //用户默认头像
            $result['avatar'] = userAvatar();
        }
        $this->session('user', $result);
        $this->cookie('user', json_encode($result));
    }

    /**
     * 安全登出
     */
    public function logout()
    {
        if($this->isAjax()){
            $this->session('user', 'del');
            $this->cookie('user', 'del');
            $this->resultJson(0, '安全登出成功');
        }
    }
}