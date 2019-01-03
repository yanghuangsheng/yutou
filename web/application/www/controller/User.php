<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/18
 * Time: 10:47
 */

namespace app\www\controller;


class User extends Base
{
    /**
     * 登陆
     * @return mixed
     */
    public function login()
    {
        $this->saveLogin();

        $this->view->engine->layout('layout/not');
        return $this->fetch();
    }

    /**
     * 注册
     * @return mixed
     */
    public function register()
    {
        $this->saveLogin();

        $this->view->engine->layout('layout/not');
        return $this->fetch();
    }

    /**
     * 安全退出
     * @return mixed
     */
    public function logout()
    {
        return (new \app\www\logic\User)->logout();
    }

    /**
     * 发布帖子
     * @return mixed
     */
    public function publishPost()
    {
        (new \app\www\logic\Forum)->pubPost();

        $this->view->engine->layout('layout/not');
        return $this->fetch();
    }


    /**
     * 用户主页
     * @param $user_id
     * @return mixed
     */
    public function index($user_id)
    {
        $user = new \app\www\logic\User;
        $this->loadForumPostList($user);

        $data = $user->oneUserinfo($user_id);
        //用户帖子列表
        $data['post_list'] = $user->userForumPost($data['id']);
        //print_r($data);
        $this->assign('data', $data);

        return $this->fetch();
    }

    /**
     * 我的消息
     * @return mixed
     */
    public function remind()
    {
        $data = (new \app\www\logic\User)->myUserInfo();
        $this->assign('data', $data);

        return $this->fetch();
    }

    /**
     * 我的收藏
     * @return mixed
     */
    public function collection()
    {
        $data = (new \app\www\logic\User)->myUserInfo();
        $this->assign('data', $data);

        return $this->fetch();
    }


    /**
     * 基本信息
     * @return mixed
     */
    public function info()
    {
        $logic = new \app\www\logic\User;
        $logic->saveInfo();


        $data = $logic->readOneInfo();
        $this->assign('data', $data);

        return $this->fetch();
    }

    /**
     * 上传头像
     */
    public function uploadAvatarImage()
    {
        (new \app\www\logic\User)->uploadAvatarImage();
    }

    /**
     * 修改密码
     * @return mixed
     */
    public function updatePass()
    {
        return $this->fetch();
    }

    /**
     * 绑定手机
     * @return mixed
     */
    public function bindPhone()
    {
        (new \app\www\logic\User)->saveBindPhone();

        return $this->fetch();
    }

    /**
     * 上传图片
     */
    public function uploadCoverImage()
    {

        (new \app\www\logic\Forum)->uploadImage();
    }

    /**
     * 上传贴子内容图片
     */
    public function uploadContentImage()
    {
        (new \app\www\logic\Forum)->uploadImage('content', [700,700]);
    }





    /**
     * 发送验证码
     */
    public function sendSms()
    {
        return (new \app\www\logic\Sms)->send();
    }

    /**
     * 处理登陆与注册
     */
    protected function saveLogin()
    {
        return (new \app\www\logic\User)->login();
    }

    /**
     * 用户帖子加载更多
     * @param $user
     */
    protected function loadForumPostList($user)
    {
        if($this->isFormat('post_list')){
            $user->formatUserForumPost();
        }
    }
}