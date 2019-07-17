<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/13
 * Time: 17:50
 */

namespace app\api\controller\v1;

use \app\api\logic\User as Logic;
use \app\api\logic\Sms;

class User extends Base
{
    /**
     * 用户检测签到
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function checkTodaySign()
    {
        (new Logic)->checkTodaySign();
    }

    /**
     * 签到
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function todaySign()
    {
        (new Logic)->todaySign();
    }

    /**
     * 签到详情
     * @throws \app\api\exception\SuccessException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function todayDetails()
    {
        (new Logic)->todayDetails();
    }

    /**
     * 个人主页内容
     * @throws \app\api\exception\SuccessException
     */
    public function home()
    {
        (new Logic)->getHome();
    }

    /**
     * 更新每日任务
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function upTask()
    {
        (new Logic)->updateTask();
    }

    /**
     * 登陆
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     */
    public function login()
    {
        (new Logic)->login();
    }

    /**
     * 注册
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     */
    public function register()
    {
        (new Logic)->login();
    }

    /**
     * 找回密码
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     */
    public function retrieve()
    {
        (new Logic)->retrievePassword();
    }

    /**
     * 微信小程序登陆
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     */
    public function mpWxLogin()
    {
        (new Logic)->saveMpWxLogin();
    }

    /**
     * 发送验证
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     */
    public function sendSms()
    {
        (new Sms)->send();
    }

    /**
     * 关注用户
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function fans()
    {
        (new Logic)->fans();
    }

    /**
     * 取关用户
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     */
    public function noFans()
    {
        (new Logic)->noFans();
    }

    /**
     * 用户的粉丝
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     */
    public function myFans()
    {
        (new Logic)->myFans();
    }

    /**
     * 用户的关注
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     */
    public function myFollow()
    {
        (new Logic)->myFollow();
    }

    /**
     * 属性
     * @throws \app\api\exception\SuccessException
     */
    public function arr()
    {
        (new Logic)->arr();
    }

    /**
     * 用户信息
     * @throws \app\api\exception\SuccessException
     */
    public function info()
    {
        (new Logic)->info();
    }

    /**
     * 我的鱼泡
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     */
    public function golds()
    {
        (new Logic)->golds();
    }

    /**
     * 我的鱼鳞
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     */
    public function scale()
    {
        (new Logic)->scale();
    }

    /**
     * 获取提现客度
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     */
    public function quota()
    {
        (new Logic)->quota();
    }

    /**
     * 兑换额度
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     */
    public function exchangeQuota()
    {
        (new Logic)->exchangeQuota();
    }

    /**
     * 提现
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     */
    public function exchangeCash()
    {
        (new Logic)->exchangeCash();
    }

    /**
     * 加载更多交易日志
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     */
    public function moreCapitalLog()
    {

        (new Logic)->moreCapitalLog();
    }

    /**
     * 兑换记录
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     */
    public function exchangeLog()
    {
        (new Logic)->exchangeLog();
    }

    /**
     * 更新用户信息
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     */
    public function setInfo()
    {
        (new Logic)->updateInfo();
    }

    /**
     * 上传头像
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     */
    public function uploadAvatar()
    {
        (new Logic)->uploadAvatarImage();
    }

    /**
     * 绑定手机
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     */
    public function bindPhone()
    {
        (new Logic)->bindPhone();
    }

    /**
     * 我的帖子
     * @throws \app\api\exception\SuccessException
     */
    public function myPost()
    {
        (new Logic)->forumPost();
    }

    /**
     * 加载更多 我的帖子
     * @throws \app\api\exception\SuccessException
     */
    public function moreMyPost()
    {
        (new Logic)->moreForumPost();
    }

    /**
     * 加载更多用户的评论
     * @throws \app\api\exception\SuccessException
     */
    public function moreMyComment()
    {
        (new Logic)->moreMyComment();
    }

    /**
     * 我的收藏
     * @throws \app\api\exception\SuccessException
     */
    public function collection()
    {
        (new Logic)->collection();
    }

    /**
     * 我的收藏 加载更多
     * @throws \app\api\exception\SuccessException
     */
    public function moreCollection()
    {
        (new Logic)->moreCollection();
    }

    /**
     * 上传帖子图片
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     */
    public function uploadForumImage()
    {
        (new Logic)->uploadForumImage();
    }

    /**
     * 发布帖子
     * @throws \app\api\exception\ErrorException
     * @throws \app\api\exception\SuccessException
     */
    public function pubForumPost()
    {
        (new logic)->pubForumPost();
    }


}