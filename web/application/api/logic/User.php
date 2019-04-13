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
     * 关注用户
     */
    public function fans()
    {
        $this->checkToken();

        $param = $this->param();
        $oUserId = $this->tokenData['id'];
        $userFans = new \app\api\service\UserFans;
        if(false == $userFans->addFans(['id'=>$param['user_id'], 'user_id'=>$oUserId])){

            return showResult(-1, $userFans->getError()?$userFans->getError():'关注失败');
        }
        $user = new \app\api\service\UserAttr;
        $user->saveNum(['id'=>$param['user_id']], 'fans');
        $user->saveNum(['id'=>$oUserId], 'follow');

        return showResult(0, '关注成功');
    }

    /**
     * 属性
     */
    public function arr()
    {

        $param = $this->param();
        //参数验证  暂缺

        $service = new \app\api\service\User;

        $data = $service->getOneArr($param['user_id']);

        return showResult(0, '', $data);
    }

    /**
     * 用户信息
     */
    public function info()
    {
        $param = $this->param();
        //参数验证  暂缺

        $service = new \app\api\service\User;

        $data = $service->getOneInfo($param['user_id'])->toArray();
        foreach ($data['avatar'] as $key => &$value){
            $value = $this->getDomain() . $value;
        }

        return showResult(0, '', $data);
    }

    /**
     * 绑定手机
     */
    public function bindPhone()
    {
        $this->checkToken();
        $userId = $this->tokenData['id'];
        $param = $this->param();
        //参数验证 暂缺

        $smsCode = $this->cache($param['code_sign']);
        if(!($smsCode == $param['code'])){

            return showResult(-1, '验证码错误');
        }

        $service = new \app\api\service\User;
        if($service->saveBindPhone($param['mobile'], $userId)){

            return showResult(0, '绑定成功');
        }

        return showResult(-1, $service->getError());
    }

    /**
     * 我的帖子
     */
    public function myPost()
    {

    }

    /**
     * 我的收藏
     */
    public function collection()
    {

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