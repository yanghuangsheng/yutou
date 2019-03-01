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
     * 第三方授权登陆跳转
     */
    public function jump()
    {
        if($url = (new \app\www\logic\User)->authUrl()){
            $this->redirect($url);
        }
    }

    /**
     * 第三访登陆回调
     */
    public function callback()
    {
        if($url = (new \app\www\logic\User)->authCallback()){
            if(is_bool($url)){
                $url = '/';
            }
            //exit ('<script language=JavaScript> top.location.href = ' .$url. '; </script>');
            $this->redirect($url);
        }

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
        $data = (new \app\www\logic\Forum)->pubPost();

        $this->view->engine->layout('layout/not');
        $this->assign('data', $data);
        //print_r($data);
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
        $this->delForumPost($user);

        $data = $user->oneUserinfo($user_id);
        //用户帖子列表
        $data['post_list'] = $user->userForumPost($data['id']);
        //print_r($data);
        $this->init(['title'=>'【'.$data['name'].'】的个人中心']);
        $this->getBroadcast($user);
        $this->assign('data', $data);

        return $this->fetch();
    }

    /**
     * 我的消息
     * @return mixed
     */
    public function remind()
    {
        $user = new \app\www\logic\User;
        $this->loadInteractionList($user);
        $this->loadSystemList($user);
        $this->clearSystem($user);
        $this->clearInteraction($user);

        $data = $user->myUserInfo();
        $data['system_list'] = $user->messageList(0);
        $data['interaction_list'] = $user->messageList(1);
        //print_r($data['system_list']);
        $this->getBroadcast($user);
        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 我的收藏
     * @return mixed
     */
    public function collection()
    {
        $user = new \app\www\logic\User;
        $this->loadCollectNewsList($user);
        $this->loadCollectPostList($user);
        $this->delCollection($user);
        $this->getFormatUser($user);
        $this->userFans($user);


        $data = $user->myUserInfo();
        $data['collect'] = [
            'news' => $user->collectNewsList($data['id']),
            'post' => $user->collectPostList($data['id']),
        ];

        //print_r($data);
        $this->getBroadcast($user);
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

    /**
     * 删除用户帖子
     * @param $user
     */
    protected function delForumPost($user)
    {
        if($this->isFormat('del_post')){
            $user->formatForumPostDel();
        }
    }


    /**
     * 加载更多收藏新闻
     * @param $user
     */
    protected function loadCollectNewsList($user){
        if($this->isFormat('news_list')){
            $user->formatCollectNewsList();
        }
    }

    /**
     * 加载更多收藏新闻
     * @param $user
     */
    protected function loadCollectPostList($user){
        if($this->isFormat('post_list')){
            $user->formatCollectPostList();
        }
    }

    /**
     * 删除收藏
     * @param $user
     */
    protected function delCollection($user)
    {
        if($this->isFormat('del_collect')){
            $user->formatCollectDel();
        }
    }

    /**
     * 展示用户个人信息
     * @param $user
     * @return mixed
     */
    protected function getFormatUser($user)
    {
        if($this->isFormat('show_user')){
            return $user->formatUser();
        }
    }

    /**
     * 关注用户
     * @param $user
     * @return mixed
     */
    protected function userFans($user)
    {
        if($this->isFormat('fans')) {
            return $user->userFans();
        }
    }

    /**
     * 标记系统信息已读
     * @param $user
     * @return mixed
     */
    protected function clearSystem($user)
    {
        if($this->isFormat('clear_system')){
            return $user->clearSystem();
        }
    }

    /**
     * 标记互动信息已读
     * @param $user
     * @return mixed
     */
    protected function clearInteraction($user)
    {
        if($this->isFormat('clear_interaction')){
            return $user->clearInteraction();
        }
    }

    /**
     * 加载互动消息
     * @param $user
     * @return mixed
     */
    protected function loadInteractionList($user)
    {
        if($this->isFormat('interaction_list')){
            return $user->formatMessageList(1);
        }
    }

    /**
     * 加载第统消息
     * @param $user
     * @return mixed
     */
    protected function loadSystemList($user)
    {
        if($this->isFormat('system_list')){
            return $user->formatMessageList(0);
        }
    }

    /**
     * 广播
     * @param $user
     */
    protected function getBroadcast($user)
    {
        $data = $user->getBroadcast();
        $this->assign('broadcast', $data['list']);
    }
}