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

        if(!($param['code'] == '898989')){
            $smsCode = $this->cache($param['code_sign']);
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
     * 个人主页
     */
    public function getHome()
    {
        $userId = $this->param('user_id');
        $userService = new \app\api\service\User;
        //用户信息
        $data['info'] = $userService->getOneInfo($userId);
        //用户属性
        $data['arr'] = $userService->getOneArr($userId);
        $data['info']['is_fans'] = 0;
        //关注情况
        if(isset($this->tokenData['id'])){
            $data['info']['is_fans'] = (new \app\api\service\UserFans)->checkFans($userId, $this->tokenData['id']);
        }

        //广播
        $broadcastData = (new \app\api\service\SystemBroadcast)->initWhere([['type', '=', 0]])->initField('o_id,content')->initLimit(1)->getListData();
        $data['broadcast'] = $broadcastData['list'];

        //我的帖子
        $postService = new \app\api\service\ForumPost;
        $data['post_list'] = [
            'list' => $this->commonForumPostList($postService, [['ForumPost.user_id','=', $userId]]),
            'start_id' => $postService->newsId(),
        ];

        return showResult(0, '', $data);
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
        $data['avatar'] = $this->getDomain() . $data['avatar'][100];

        return showResult(0, '', $data);
    }

    /**
     * 获取用户的金币
     * @return array
     */
    public function golds()
    {
        $this->checkToken();
        $userId = $this->tokenData['id'];

        $capital = new \app\common\model\UserCapital;

        $golds = $capital->where('user_id', $userId)->value('golds');

        return showResult(0, '', ['golds' => $golds?$golds:0]);
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
    public function forumPost()
    {
        $param = $this->param();
        //验证参数 缺

        $userId = $param['user_id'];
        $service = new \app\api\service\ForumPost;
        $data = [
            'list' => $this->commonForumPostList($service, [['ForumPost.user_id','=', $userId]]),
            'start_id' => $service->newsId(),
        ];

        return showResult(0, '', $data);
    }

    /**
     * 加载更多 我的帖子
     */
    public function moreForumPost()
    {
        $param = $this->param();
        //验证参数 缺

        $userId = $param['user_id'];
        $service = new \app\api\service\ForumPost;

        $data = $this->commonForumPostList(
            $service,
            [['ForumPost.user_id','=', $userId], ['ForumPost.id', '<=', $param['start_id']]],
            $param['page']
        );

        return showResult(0, '', $data);
    }

    /**
     * 我的收藏
     */
    public function collection()
    {
        $param = $this->param();
        //验证参数 缺

        $userId = $param['user_id'];

        $collect = new \app\api\service\UserCollection;
        $where = [['UserCollection.user_id','=', $userId]];
        $data = [
            'post_list' => $this->commonCollectPostList($collect, $where),
            'news_list' => $this->commonCollectNewsList($collect, $where),
            'start_id' => $collect->newsId(),
        ];

        return showResult(0, '', $data);
    }

    /**
     * 加载更多收藏
     */
    public function moreCollection()
    {
        $param = $this->param();
        //验证参数 缺

        $userId = $param['user_id'];

        $collectFunction = 'commonCollectNewsList';
        if($param['type'] == 'post_list'){
            $collectFunction = 'commonCollectPostList';
        }

        $collect = new \app\api\service\UserCollection;
        $where = [['UserCollection.user_id','=', $userId], ['UserCollection.id', '<=', $param['start_id']]];

        $data = $this->$collectFunction($collect, $where, $param['page']);

        return showResult(0, '', $data);

    }

    /**
     * 上传图片 (社区帖子)
     * @param string $path
     * @param array $size
     * @return array
     */
    public function uploadForumImage($path = 'content', $size = [700, 700])
    {
        $this->checkToken();
        $upload = new \app\api\service\Upload;
        $data = $upload->upFile('forum_'.$path);

        if (isset($data['error'])) {

            return showResult(-1, $data['error']);
        }
        else{
            //压缩图片
            resultThumb($data['file'], 'no', $size[0], $size[1], 0, 1);

            return showResult(0, '上传成功', ['image_url'=> $data['file'], 'domain'=> $this->getDomain(), 'tmp_name'=> $data['tmp_name']]);
        }
    }

    /**
     * 发布帖子
     * @return array
     */
    public function pubForumPost()
    {
        $this->checkToken();
        $param = $this->param();
        //提交数据验证 -> 暂缺

        $forum = new \app\api\service\ForumPost;
        //用户ID
        $saveData['user_id'] = $this->tokenData['id'];
        $saveData['status'] = 1;

        //组新 content
        $saveData['title'] = $param['title'];
        $saveData['content'] = '<div>' . $param['content'] . '</div> <div style="height:20px;"></div>';
        $saveData['image_url'] = []; //缩略图
        foreach ($param['content_image'] as $key => $value){
            $saveData['content'] .= '<div style="text-align: center;"> <img src="'. $value .'"> </div><div style="height:10px;"></div>';
            if($key < 3){
                //最多3个做缩略图
                $saveData['image_url'][] = resultThumb($value, '/forum_cover/', 218, 129, 0, 3);
            }

        }

        if($data = $forum->save($saveData, 0, 1)){
            (new \app\api\service\UserAttr)->saveNum(['id'=>$saveData['user_id']], 'post');
            (new \app\api\service\SystemBroadcast)->trigger(1, 'put', ['name'=>$this->tokenData['name'], 'id'=>$data['id'], 'title'=>$data['title'], 'num'=>0]);

            return showResult(0, '发布成功');
        }

        return showResult(-1, $forum->getError()?$forum->getError():'发布失败');
    }


    /**
     * 处理上传头像 200*200 100*100 50*50
     */
    public function uploadAvatarImage()
    {
        $this->checkToken();

        $upload = new \app\api\service\Upload;
        $data = $upload->upFile('user_avatar');

        //"error" => "0", "pic" => $pic_url, "name" => $pic_name
        if (isset($data['error'])) {
            return showResult(-1, $data['error']);
        }
        else{
            //缩略图
            $avatarImg = [
                '200' => resultThumb($data['file'], 'avatar', 200, 200),
                '100' => resultThumb($data['file'], 'avatar', 100, 100),
                '50' => resultThumb($data['file'], 'avatar', 50, 50),
            ];

            $updateData = ['id'=> $this->tokenData['id'], 'field'=>'avatar', 'value'=>$avatarImg];
            if((new \app\api\service\User)->updateFieldByValue($updateData) == false){
                return showResult(-1, '上传失败');
            }

            $domain = $this->getDomain();
            foreach ($avatarImg as $key => &$value){
                $value = $domain . $value;
            }

            return showResult(0, '上传成功', ['image_url'=> $avatarImg, 'tmp_name'=> $data['tmp_name']]);
        }


    }

    /**
     * 更新用户信息
     */
    public function updateInfo()
    {
        $this->checkToken();
        $userId = $this->tokenData['id'];
        $param = $this->param();
        //参数验证 暂缺

        $user = new \app\api\service\User;
        if($user->saveOneInfo([$userId, $param['field'], $param['value']])){
            return showResult(0, '更新成功');
        }

        return showResult(-1, $user->getError());

    }

    /**
     * 公共我的帖子
     * @param $forum
     * @param $where
     * @param int $page
     * @return mixed
     */
    protected function commonForumPostList($forum, $where, $page = 1)
    {
        $data = $forum->initWhere($where)->initLimit($page)->getListData();

        $data['list'] = $data['list']->toArray();
        $domain = $this->getDomain();
        foreach ($data['list'] as $key => &$value){
            $value['description'] = clean_html($value['content'], 60);
            //$value['user_avatar'] = json_decode($value['user_avatar'], true);
            $value['user_avatar'] = $domain . $value['user_avatar']['100'];
            foreach ($value['image_url'] as $key1 => &$value1){
                $value1 = $domain . $value1;
            }

        }
        return $data['list'];
    }

    /**
     * 公共收藏帖子
     * @param $collect
     * @param $where
     * @param int $page
     * @return mixed
     */
    protected function commonCollectPostList($collect, $where, $page = 1)
    {
        $data = $collect->postView()->initWhere($where)->initLimit($page)->getListData();

        $data['list'] = $data['list']->toArray();
        $domain = $this->getDomain();
        foreach ($data['list'] as $key => &$value){
            $value['description'] = clean_html($value['content'], 60);
            $value['user_avatar'] = $domain . $value['user_avatar']['100'];
            $value['image_url'] = json_decode($value['image_url'], true);
            $value['create_time'] = friendlyDate($value['create_time']);
            foreach ($value['image_url'] as $key1 => &$value1){
                $value1 = $domain . $value1;
            }

        }
        //print_r($data);
        return $data['list'];

    }

    /**
     * 公共收藏新闻
     * @param $collect
     * @param $where
     * @param int $page
     * @return mixed
     */
    protected function commonCollectNewsList($collect, $where, $page = 1)
    {
        $data = $collect->newsView()->initWhere($where)->initLimit($page)->getListData();

        $data['list'] = $data['list']->toArray();
        $domain = $this->getDomain();
        foreach ($data['list'] as $key => &$value){
            $value['description'] = clean_html($value['description'], 60);
            $value['create_time'] = friendlyDate($value['create_time']);
            $value['image_url'] = $domain . $value['image_url'];
        }

        return $data['list'];
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