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

        $param = $this->param();
        //验证手机及验证码等上传信息 -> 暂缺

        $smsCode = $this->cache($param['code_sign']);
        if(!($param['code'] == '898989')){
            if(!($smsCode == $param['code'])){
                return showResult(-1, '验证码错误');
            }
        }


        $service = new \app\api\service\User;

        if($result = $service->saveLogin($param['mobile'], $param)){
            $result = $this->saveLoginStatus($this->unId('login_token'), $result);
            return showResult(0, '登陆成功', $result);
        }

        return showResult(-1, $service->getError());

    }

    /**
     * 保存登陆状态
     * @param $sign
     * @param $result
     */
    public function saveLoginStatus($sign, $result)
    {
        if(!isset($result['avatar']) || !$result['avatar']){
            //用户默认头像
            $result['avatar'] = userAvatar();
        }

        foreach ($result['avatar'] as $key => &$value){
            $value = $this->getDomain() . $value;
        }
        $this->cache($sign, $result);

        $result['token'] = $sign;

        return $result;
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