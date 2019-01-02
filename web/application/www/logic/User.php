<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/21
 * Time: 17:16
 */

namespace app\www\logic;



class User extends Base
{
    /**
     * 获取登陆的用户信息
     */
    public function getSessionUserInfo()
    {
        $data = $this->session('user');
        isset($data['id']) || $this->cookie('user','del');
        return $this->session('user');
    }

    /**
     * 读取用户信息
     */
    public function readOneInfo()
    {
        $userId =  $this->session('user')['id'];

        $data = (new \app\www\service\User)->getOneData($userId);

        return $data;

    }

    /**
     * 个人主页相关信息
     * @param $user_id
     * @return array|null|\PDOStatement|string|\think\Model
     */
    public function oneUserInfo($user_id)
    {
        $data = (new \app\www\service\User)->getOneData($user_id);
        //默认
        $data['isEdit'] = 0;
        //如果存在登陆
        if(isset($this->session('user')['id']) && $this->session('user')['id'] == $user_id){
            $data['isEdit'] = 1;
        }


        return $data;
    }



    /**
     * 修改用户信息
     */
    public function saveInfo()
    {
        if($this->isAjax()){
            $userId =  $this->session('user')['id'];
            $data = $this->param();
            //相关一系列验证 -> 暂缺
            $service = new \app\www\service\User;
            if( $service->saveInfo($data, $userId) ){
                //改变session
                $sessionData = $this->session('user');
                $sessionData['name'] = $data['name'];
                $this->session('user', $sessionData);

                $this->resultJson(0, '保存成功');
            }

            $this->resultJson(-1, $service->getError());
        }
    }

    /**
     * 处理上传头像 200*200 100*100 50*50
     */
    public function uploadAvatarImage()
    {

        $upload = new \app\www\service\Upload;
        $data = $upload->upFile('user_avatar');

        //"error" => "0", "pic" => $pic_url, "name" => $pic_name
        if (isset($data['error'])) {
            $this->resultJson(-1, $data['error']);
        }
        else{
            //缩略图
            $avatarImg = [
                '200' => resultThumb($data['file'], 'avatar', 200, 200),
                '100' => resultThumb($data['file'], 'avatar', 100, 100),
                '50' => resultThumb($data['file'], 'avatar', 50, 50),
            ];

            $updateData = ['id'=> $this->session('user')['id'], 'field'=>'avatar', 'value'=>$avatarImg];
            if((new \app\www\service\User)->updateFieldByValue($updateData) == false){
                $this->resultJson(-1, '上传失败');
            }

            //改变session
            $sessionData = $this->session('user');
            $sessionData['avatar'] = $avatarImg;
            $this->session('user', $sessionData);

            //改变cookie
            $cookieData = $this->cookie('user');
            if($cookieData){
                $cookieData = json_decode($cookieData, true);
                $cookieData['avatar'] = $avatarImg;
                $this->cookie('user', json_encode($cookieData));
            }

            $this->resultJson(0, '上传成功', ['image_url'=> $data['file'], 'tmp_name'=> $data['tmp_name']]);
        }





    }

    /**
     * 保存用户绑定的手机
     */
    public function saveBindPhone()
    {
        if($this->isAjax()){
            $userId =  $this->session('user')['id'];
            $data = $this->param();
            //相关一系列验证 -> 暂缺

            $smsCode = $this->session('sms_code');
            if(!($smsCode == $data['code'])){
                $this->resultJson(-1, '验证码错误');
            }

            $service = new \app\www\service\User;
            if( $service->saveBindPhone($data['mobile'], $userId) ){

                $this->resultJson(0, '绑定成功');
            }

            $this->resultJson(-1, $service->getError());
        }
    }


    /**
     * 登陆
     */
    public function login()
    {
        if($this->isAjax()){
            $data = $this->param();
            //验证手机及验证码等上传信息 -> 暂缺

            $smsCode = $this->session('sms_code');
            if(!($smsCode == $data['code']) || !($smsCode == '898989')){
                $this->resultJson(-1, '验证码错误');
            }

            $service = new \app\www\service\User;

            if($result = $service->saveLogin($data['mobile'], $data)){
                $this->session('user', $result);
                $this->cookie('user', json_encode($result));

                $this->resultJson(0, '登陆成功');
            }


            $this->resultJson(-1, $service->getError());


        }
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