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
     * 用户检测签到
     */
    public function checkTodaySign()
    {
        return (new Logic)->checkTodaySign();
    }

    /**
     * 签到
     * @return array
     * @throws \app\api\exception\ApiException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function todaySign()
    {
        return (new Logic)->todaySign();
    }

    /**
     * 签到详情
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function todayDetails()
    {
        return (new Logic)->todayDetails();
    }

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
     * 找回密码
     * @return mixed
     */
    public function retrieve()
    {
        return (new Logic)->retrievePassword();
    }

    /**
     * 微信小程序登陆
     */
    public function mpWxLogin()
    {
        return (new Logic)->saveMpWxLogin();
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


    public function noFans()
    {

    }

    /**
     * 用户的粉丝
     * @return mixed
     * @throws \app\api\exception\ApiException
     */
    public function myFans()
    {
        return (new Logic)->myFans();
    }

    /**
     * 用户的关注
     * @return mixed
     * @throws \app\api\exception\ApiException
     */
    public function myFollow()
    {
        return (new Logic)->myFollow();
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
     * 我的鱼泡
     * @return array
     * @throws \app\api\exception\ApiException
     */
    public function golds()
    {
        return (new Logic)->golds();
    }

    /**
     * 我的鱼鳞
     * @return array
     * @throws \app\api\exception\ApiException
     */
    public function scale()
    {
        return (new Logic)->scale();
    }

    /**
     *
     */
    public function moreCapitalLog()
    {

        return (new Logic)->moreCapitalLog();
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
     * 加载更多用户的评论
     * @return array
     */
    public function moreMyComment()
    {
        return (new Logic)->moreMyComment();
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