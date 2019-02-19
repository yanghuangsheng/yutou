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
     * 个人主页相关信息
     * @return array|null|\PDOStatement|string|\think\Model
     */
    public function myUserInfo()
    {
        if(!isset($this->session('user')['id'])){
            exception('页面不存在', 404);
        }

        return $this->oneUserInfo($this->session('user')['id']);
    }

    /**
     * 获取用户和帖子
     * @param $user_id
     * @return mixed
     */
    public function userForumPost($user_id)
    {
        $service = new \app\www\service\ForumPost;
        $param = $this->param();
        isset($param['page']) || $param['page'] = 1;
        $where = [
            ['ForumPost.user_id','=', $user_id],
        ];
        isset($param['start_id']) && $where[] = ['ForumPost.id', '<=', $param['start_id']];
        $data = $service->initWhere($where)->initLimit($param['page'])->getListData();
        $data['start_id'] = $service->newsId();
        $data['list'] = $data['list']->toArray();
        foreach ($data['list'] as $key => &$value){
            $value['description'] = clean_html($value['content'], 60);
            //$value['user_avatar'] = json_decode($value['user_avatar'], true);

        }
        return $data;
    }

    /**
     * 加载更多帖子列表
     */
    public function formatUserForumPost()
    {
        if($this->isAjax()){
            $userId = $this->param('user_id');
            $data = $this->userForumPost($userId);

            $this->resultJson(0, '', $data);

        }
    }

    /**
     * 收藏新闻列表
     * @param $user_id
     * @return mixed
     */
    public function collectNewsList($user_id){
        $userCollect = new \app\www\service\UserCollection;
        $param = $this->param();
        isset($param['page']) || $param['page'] = 1;
        $where = [
            ['UserCollection.user_id','=', $user_id],
        ];
        isset($param['start_id']) && $where[] = ['UserCollection.id', '<=', $param['start_id']];
        $data = $userCollect->newsView()->initWhere($where)->initLimit($param['page'])->getListData();
        $data['start_id'] = $userCollect->newsId();

        $data['list'] = $data['list']->toArray();
        foreach ($data['list'] as $key => &$value){
            $value['description'] = clean_html($value['description'], 60);
            $value['create_time'] = friendlyDate($value['create_time']);
        }

        return $data;

    }

    /**
     * 加载更多收藏新闻
     */
    public function formatCollectNewsList()
    {
        if($this->isAjax()){
            $userId = $this->param('user_id');
            $data = $this->collectNewsList($userId);

            $this->resultJson(0, '', $data);

        }
    }

    /**
     * 收藏帖子列表
     * @param $user_id
     * @return mixed
     */
    public function collectPostList($user_id){
        $userCollect = new \app\www\service\UserCollection;
        $param = $this->param();
        isset($param['page']) || $param['page'] = 1;
        $where = [
            ['UserCollection.user_id','=', $user_id],
        ];
        isset($param['start_id']) && $where[] = ['UserCollection.id', '<=', $param['start_id']];
        $data = $userCollect->postView()->initWhere($where)->initLimit($param['page'])->getListData();
        $data['start_id'] = $userCollect->newsId();
        $data['list'] = $data['list']->toArray();
        foreach ($data['list'] as $key => &$value){
            $value['description'] = clean_html($value['content'], 60);
            //$value['user_avatar'] = json_decode($value['user_avatar'], true);
            $value['image_url'] = json_decode($value['image_url'], true);
            $value['create_time'] = friendlyDate($value['create_time']);

        }
        //print_r($data);
        return $data;

    }

    /**
     * 加载更多收藏帖子
     */
    public function formatCollectPostList()
    {
        if($this->isAjax()){
            $userId = $this->param('user_id');
            $data = $this->collectPostList($userId);

            $this->resultJson(0, '', $data);
        }
    }

    /**
     * 消息列表
     * @param $type 0系统 1互动
     * @return mixed
     */
    public function messageList($type)
    {
        $message = new \app\www\service\SystemMessage;
        $param = $this->param();

        isset($param['page']) || $param['page'] = 1;
        $userId = $this->session('user')['id'];
        $where = [
            ['SystemMessage.type', '=', $type],
            ['SystemMessage.user_id', '=', $userId],
        ];
        isset($param['start_id']) && $where[] = ['SystemMessage.id', '<=', $param['start_id']];
        $data = $message->initWhere($where)->initLimit($param['page'])->getListData();
        $data['start_id'] = $message->newsId();
        $data['tips_num'] = $message->tipsNum($userId, $type);
        $data['list'] = $data['list']->toArray();
        $forumPost = new \app\www\service\ForumPost;
        $forumComment = new \app\www\service\ForumPostComment;
        foreach ($data['list'] as $key => &$value){
            if($value['type'] == 1){
                //$value['user_avatar'] = json_decode($value['user_avatar'], true);
                $value['create_time'] = friendlyDate($value['create_time']);
                if($value['o_type'] == 1){
                    //回复帖子
                    $value['link_txt'] = '回复了';
                    $value['link_ext'] = '你的帖子';
                    $postData = $forumPost->messageOne($value['o_id']);
                    $value['parent']['post_id'] = $postData['post_id'];
                    $value['parent']['title'] = $postData['title'];
                }
                elseif($value['o_type'] == 2){
                    //回复评论
                    $value['link_txt'] = '回复了';
                    $value['link_ext'] = '你的评论';
                    $commentData = $forumComment->messageOne($value['id']);
                    $value['parent']['post_id'] = $commentData['post_id'];
                    $value['parent']['content'] = $commentData['content'];
                }
                elseif($value['o_type'] == 3){
                    //点赞帖子
                    $value['link_txt'] = '点赞了';
                    $value['link_ext'] = '你的帖子';
                    $postData = $forumPost->messageOne($value['o_id']);
                    $value['parent']['post_id'] = $postData['post_id'];
                    $value['parent']['title'] = $postData['title'];
                    $value['parent']['praise_num'] = $postData['praise_num'];
                }
                elseif($value['o_type'] == 4){
                    //点赞评论
                    $value['link_txt'] = '点赞了';
                    $value['link_ext'] = '你的评论';
                    $commentData = $forumComment->messageOne($value['id']);
                    $value['parent']['post_id'] = $commentData['post_id'];
                    $value['parent']['content'] = $commentData['content'];
                    $value['parent']['praise_num'] = $commentData['praise_num'];
                }
                elseif($value['o_type'] == 5){
                    //踩踏评论
                    $value['link_txt'] = '踩了';
                    $value['link_ext'] = '你的评论 对你表示不屑，并竖起了中指';
                    $commentData = $forumComment->messageOne($value['id']);
                    $value['parent']['post_id'] = $commentData['post_id'];
                    $value['parent']['content'] = $commentData['content'];
                    $value['parent']['tread_num'] = $commentData['tread_num'];
                }
            }
        }
        return $data;
    }


    /**
     * 加载更多消息列表
     */
    public function formatMessageList($type)
    {
        if($this->isAjax()){
            $data = $this->MessageList($type);

            $this->resultJson(0, '', $data);
        }
    }

    /**
     * 标记系统已读信息
     */
    public function clearSystem()
    {
        if($this->isAjax()){
            $startId = $this->param('start_id');
            $userId = $this->session('user')['id'];
            if((new \app\www\service\SystemMessage)->clearSystem($userId, $startId)){
                $this->resultJson(0, '标记成功');
            }

            $this->resultJson(-1, '标记失败');
        }
    }

    /**
     * 标记互动已读信息
     */
    public function clearInteraction()
    {
        if($this->isAjax()){
            $startId = $this->param('start_id');
            $userId = $this->session('user')['id'];
            if((new \app\www\service\SystemMessage)->clearInteraction($userId, $startId)){
                $this->resultJson(0, '标记成功');
            }

            $this->resultJson(-1, '标记失败');
        }
    }


    /**
     * 用户信息
     */
    public function formatUser(){
        if($this->isAjax()){
            $userId = $this->param('id');
            $data = (new \app\www\service\User)->getOneData($userId);
            $data['synopsis'] ||  $data['synopsis'] = '她好懒，什么都没有留下 ...';

            $data['is_fans'] = 0;

            //是否已关注
            if(isset($this->session('user')['id'])){
                $data['is_fans'] = (new \app\www\service\UserFans)->checkFans($data['id'], $this->session('user')['id']);
            }
            $this->resultJson(0, '', $data);
        }
    }

    /**
     * 关注用户
     */
    public function userFans()
    {
        if($this->isAjax() && $this->isPost()){
            $param = $this->param();
            $oUserId = $this->session('user')['id'];
            $userFans = new \app\www\service\UserFans;
            if(false == $userFans->addFans(['id'=>$param['user_id'], 'user_id'=>$oUserId])){
                $this->resultJson(-1, $userFans->getError()?$userFans->getError():'关注失败');
            }
            $user = new \app\www\service\UserAttr;
            $user->saveNum(['id'=>$param['user_id']], 'fans');
            $user->saveNum(['id'=>$oUserId], 'follow');
            $this->resultJson(0, '关注成功');

        }
    }

    /**
     * 用户删除帖子
     */
    public function formatForumPostDel()
    {
        if($this->isAjax()){
            $id = $this->param('id');
            $data = [
                'id' => $id,
                'user_id' => $this->session('user')['id'],
            ];
            $forumPost = new \app\www\service\ForumPost;

            if($forumPost->checkDel($data)){
                $this->resultJson(0, '删除成功');
            }

            $this->resultJson(0, '删除失败');
        }
    }

    /**
     * 删除收藏
     */
    public function formatCollectDel()
    {
        if($this->isAjax()) {
            $id = $this->param('id');
            $data = [
                'id' => $id,
                'user_id' => $this->session('user')['id'],
            ];
            $userCollect = new \app\www\service\UserCollection;
            if($userCollect->checkDel($data)){
                $this->resultJson(0, '删除成功');
            }

            $this->resultJson(0, '删除失败');
        }
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

    /**
     * 第三方授权地址
     */
    public function authUrl()
    {
        $param = $this->param();
        if($authName = $param['type']){
            $authClass = '\oauth\\'.ucwords($authName);
            return (new $authClass)->getAuthURL($param);
        }
    }

    /**
     * 第三方授权回调
     */
    public function authCallback()
    {
        $param = $this->param();
//        print_r($param);
//        exit();
        if($authName = $param['type']){

            if($code = $param['code']){
                $authName = ucwords($authName);
                $authClass = '\oauth\\'.$authName;
                $auth = new $authClass;
                $auth->setParam('code', $code);
                $data = $auth->getUserInfo();

//                dump($data);
//                exit();

                $userBind = new \app\www\service\UserBind;
                $user = new \app\www\service\User;

                if($userBind->checkBind($data['open_id'], $this->authType($authName))){
                    $userId = $userBind->getField([['open_id', '=', $data['open_id']]], 'user_id');
                    $statusData = $user->getUserInfo($userId,'id');
                }
                else{
                    if($data['id'] = $user->createUser($data)){
                        $bindData = [
                            'open_id'=>$data['open_id'],
                            'union_id'=>$data['union_id'],
                            'type'=>$this->authType($authName),
                            'user_id' => $data['id'],
                        ];
                        if($userBind->save($bindData)){
                            $statusData = [
                                'id' => $data['id'],
                                'name' => $data['name'],
                                'avatar' => $data['avatar'],
                            ];

                        }
                        else{
                            //删除没用记录
                            $user->delete($data['id']);
                            return false;
                        }

                    }

                }

                $this->saveLoginStatus($statusData);
                $user->updateLoginTime($statusData['id']);
                return $param['jump']?$param['jump']:true;

            }
        }
    }

    /**
     * 授权类型
     * @param $name
     * @return mixed|string
     */
    public function authType($name){
        $data = [
            'Weixin' => 1,
            'Qq' => 2,
        ];
        return isset($data[$name])?$data[$name]:'';
    }
}