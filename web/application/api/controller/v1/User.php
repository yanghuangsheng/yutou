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
     * 个人主页内容
     */
    public function home()
    {
        return (new Logic)->getHome();
    }

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
     * @return mixed
     */
    public function sendSms()
    {
        $sms = new \app\api\logic\Sms;

        return $sms->send();
    }

    /**
     * 关注用户
     * @return mixed
     */
    public function fans()
    {
        return (new Logic)->fans();
    }

    /**
     * 属性
     * @return mixed
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
     * 我的鱼头币
     * @return mixed
     */
    public function golds()
    {
        return (new Logic)->golds();
    }

    /**
     * 更新用户信息
     * @return mixed
     */
    public function setInfo()
    {
        return (new Logic)->updateInfo();
    }

    /**
     * 上传头像
     * @return array
     */
    public function uploadAvatar()
    {
        return (new Logic)->uploadAvatarImage();
    }

    /**
     * 绑定手机
     * @return array
     */
    public function bindPhone()
    {
        return (new Logic)->bindPhone();
    }

    /**
     * 我的帖子
     * @return array
     */
    public function myPost()
    {
        return (new Logic)->forumPost();
    }

    /**
     * 加载更多 我的帖子
     * @return array
     */
    public function moreMyPost()
    {
        return (new Logic)->moreForumPost();
    }

    /**
     * 我的收藏
     * @return array
     */
    public function collection()
    {
        return (new Logic)->collection();
    }

    /**
     * 我的收藏 加载更多
     * @return array
     */
    public function moreCollection()
    {
        return (new Logic)->moreCollection();
    }

    /**
     * 上传帖子图片
     * @return array
     */
    public function uploadForumImage()
    {
        return (new Logic)->uploadForumImage();
    }

    /**
     * 发布帖子
     */
    public function pubForumPost()
    {
        return (new logic)->pubForumPost();
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