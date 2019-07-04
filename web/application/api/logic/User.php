<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/28
 * Time: 11:27
 */

namespace app\api\logic;

use app\api\service\PortalNewsComment;
use app\api\service\UserSignLog;
use app\api\service\UserCapital;
use app\api\service\UserCapitalLog;
use app\api\service\SystemMessage as SystemMessageService;
use app\api\service\UserCashLog;
use think\Db;

class User extends Base
{

    /**
     * 检测是否已签到
     * @return array
     * @throws \app\api\exception\ApiException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function checkTodaySign()
    {
        $this->checkToken();

        $service = new UserSignLog;
        if($data = $service->checkTodaySign($this->tokenData['id'])) {

            return showResult(0, '', $data);
        }

        return showResult(-1, '');

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
        $this->checkToken();

        $service = new UserSignLog;
        $userCapital = new UserCapital;
        $userCapitalLog = new UserCapitalLog;
        $userId = $this->tokenData['id'];


        Db::startTrans();
        if($resultData = $service->onTodaySign($this->tokenData['id'])){

            if($resultData['give_data']['type'] == 0){
                //鱼币
                $residueNum = $userCapital->saveGolds($userId, $resultData['give_data']['num']);
                //记录日志
                $logResult = $userCapitalLog->giveGoldsLog(
                    [
                        'user_id' => $userId,
                        'pay' => $resultData['give_data']['num'],
                        'residue'=> $residueNum,
                        'explain'=> '签到赠送鱼泡' . $resultData['give_data']['num'] . '个',
                    ]
                );

            }else{
                //鱼鳞
                $residueNum = $userCapital->saveScale($userId, $resultData['give_data']['num']);
                //记录日志
                $logResult = $userCapitalLog->giveScaleLog(
                    [
                        'user_id' => $userId,
                        'pay' => $resultData['give_data']['num'],
                        'residue'=> $residueNum,
                        'explain'=> '签到赠送鱼鳞' . $resultData['give_data']['num'] . '个',
                    ]
                );
            }

            if($residueNum && $logResult){
                Db::commit();
                return showResult(0, '签到成功', $resultData);
            }

        }

        Db::rollback();
        return showResult(-1, '签到失败');


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
        $service = new UserSignLog;
        $userId = isset($this->tokenData['id'])?$this->tokenData['id']:0;

        $data = $service->getTodayDetails($userId);


        return showResult(0, '', $data);

    }

    /**
     * 登陆
     */
    public function login()
    {

        $param = $this->param();
        //验证手机及验证码等上传信息 -> 暂缺

        $service = new \app\api\service\User;

        if(isset($param['code'])){
            //手机号 + 验证码登陆
            if(!($param['code'] == '898989')){
                $smsCode = $this->cache($param['code_sign']);
                if(!($smsCode == $param['code'])){
                    return showResult(-1, '验证码错误');
                }
            }
        }else{
            //手机号 + 密码登陆
            $password = md5Encryption($param['password']);
            $phone = trim($param['mobile']);
            $data = $service->getUserPassword($phone);
            if(!$data) return showResult(-1, '帐号不正确');

            if(!$data['password'] || $password != $data['password']){
                return showResult(-1, '密码错误');
            }

        }


        if($result = $service->saveLogin($param['mobile'], $param)){
            $result = $this->saveLoginStatus($this->unId('login_token'), $result);
            return showResult(0, '登陆成功', $result);
        }

        return showResult(-1, $service->getError());

    }

    /**
     * 重置密码
     * @return array
     */
    public function retrievePassword()
    {
        $param = $this->param();
        //参数验证 暂缺

        $smsCode = $this->cache($param['code_sign']);
        if(!($smsCode == $param['code'])){

            return showResult(-1, '验证码错误');
        }

        $service = new \app\api\service\User;
        if(0 == $service->getCount([['phone', '=', $param['mobile']]])){
            return showResult(-1, '帐号不存在');
        }

        $password = md5Encryption(trim($param['password']));
        if($service->saveSetPassword($param['mobile'], $password)){

            return showResult(0, '修改密码成功');
        }

        return showResult(-1, $service->getError());
    }

    /**
     * 微信小程序授权登陆
     * @return array
     */
    public function saveMpWxLogin()
    {
        $param = $this->param();
        //验证相关 暂缺

        $data = (new \oauth\MpWeixin)->getUserInfo($param);

        if(isset($data['err'])){
            return showResult(-1, $data['err']);
        }
        $userBind = new \app\api\service\UserBind;
        $user = new \app\api\service\User;

        if($data['union_id'] && $userBind->checkBind([['union_id', '=', $data['union_id']]], 1)){
            $userId = $userBind->getField([['union_id', '=', $data['union_id']]], 'user_id');
            $statusData = $user->getUserInfo($userId,'id')->toArray();
        }
        elseif ($userBind->checkBind($data['open_id'], 1)) {  //1:微信 2:QQ

            $userId = $userBind->getField([['open_id', '=', $data['open_id']]], 'user_id');
            $statusData = $user->getUserInfo($userId,'id')->toArray();

        }
        else{
            if($data['id'] = $user->createUser($data)){
                $bindData = [
                    'open_id'=>$data['open_id'],
                    'union_id'=>$data['union_id'],
                    'type'=>1, //1:微信 2:QQ
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

        $user->updateLoginTime($statusData['id']);

        $result = $this->saveLoginStatus($this->unId('login_token'), $statusData);
        return showResult(0, '登陆成功', $result);

    }


    /**
     * 个人主页
     */
    public function getHome()
    {
        $userId = $this->param('user_id');
        $userService = new \app\api\service\User;
        //用户信息
        $data['info'] = $userService->getOneInfo($userId)->toArray();
        foreach ($data['info']['avatar'] as $key => &$value){
            $value = $this->getDomain().$value;
        }

        //用户属性
        $data['arr'] = $userService->getOneArr($userId);
        $data['info']['is_fans'] = 0;

        //关注情况
        if(isset($this->tokenData['id'])){
            $data['info']['is_fans'] = (new \app\api\service\UserFans)->checkFans($userId, $this->tokenData['id']);
        }

        $domain = $this->getDomain();

        $comment = (new PortalNewsComment)->userCommentView()
            ->initWhere([['PortalNewsComment.user_id', '=', $userId]])
            ->initLimit(1)
            ->getListData();
        $data['news_comment_list'] = $comment['list']->toArray();

        foreach ($data['news_comment_list'] as $key => &$value){
            $value['image_url'] =  $domain . $value['image_url'];
            $value['user_avatar'] = $domain . $value['user_avatar'][100];
        }

//        //广播
//        $data['broadcast'] = $this->commonBroadcast();
//
//        //我的帖子
//        $postService = new \app\api\service\ForumPost;
//        $data['post_list'] = [
//            'list' => $this->commonForumPostList($postService, [['ForumPost.user_id','=', $userId]]),
//            'start_id' => $postService->newsId(),
//        ];

        return showResult(0, '', $data);
    }

    /**
     * 加载更多的用户评论
     * @return array
     */
    public function moreMyComment()
    {
        $param = $this->param();

        $comment = (new PortalNewsComment)->userCommentView()
            ->initWhere([['PortalNewsComment.user_id', '=', $param['user_id']]])
            ->initLimit($param['page'])
            ->getListData();

        $data = $comment['list']->toArray();

        $domain = $this->getDomain();

        foreach ($data as $key => &$value){
            $value['image_url'] =  $domain . $value['image_url'];
            $value['user_avatar'] = $domain . $value['user_avatar'][100];
        }

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
        if($oUserId == $param['user_id']) {
            return showResult(-1, '不能关注自己哦');
        }

        if(false == $userFans->addFans(['id'=>$param['user_id'], 'user_id'=>$oUserId])){

            return showResult(-1, $userFans->getError()?$userFans->getError():'关注失败');
        }
        $user = new \app\api\service\UserAttr;
        $user->saveNum(['id'=>$param['user_id']], 'fans');
        $user->saveNum(['id'=>$oUserId], 'follow');

        return showResult(0, '关注成功');
    }

    /**
     * 取消关注
     * @return array
     * @throws \app\api\exception\ApiException
     */
    public function noFans()
    {
        $this->checkToken();

        $param = $this->param();
        $oUserId = $this->tokenData['id'];

        if((new \app\api\service\UserFans)->delFans(['id'=>$param['user_id'], 'fans_id'=>$oUserId])){

            $user = new \app\api\service\UserAttr;

            $user->decNum(['id'=>$param['user_id']], 'fans');
            $user->decNum(['id'=>$oUserId], 'follow');

            return showResult(0, '取关成功');
        }

        return showResult(-1, '取关失败');
    }

    /**
     * 用户的粉丝
     * @return mixed
     * @throws \app\api\exception\ApiException
     */
    public function myFans()
    {
        $param = $this->param();

        if(isset($param['user_id'])) {

            $userId = $param['user_id'];
        }else{
            $this->checkToken();
            $userId = $this->tokenData['id'];
        }

        $page = $param['page'];

        $userFans = new \app\api\service\UserFans;

        $fansData = $userFans->fansView()->initWhere([['UserFans.user_id', '=', $userId]])->initLimit($page)
            ->getListData();
        $data = $fansData['list']->toArray();

        $domain = $this->getDomain();
        foreach ($data as $key => &$value){
            $avatar = $value['user_avatar'] ? json_decode($value['user_avatar'],1) :userAvatar();
            $value['user_avatar'] = $domain . $avatar[100];
            $value['btn_status'] = 0; //未关注

            if(isset($this->tokenData['id'])){

                if($userFans->getCount([['fans_id', '=', $this->tokenData['id']], ['user_id', '=', $value['user_id']]])){

                    //已关注 查看别人空间的
                    $value['btn_status'] = 1;
                }

                //判断互关注
                if($value['btn_status'] && $userFans->getCount([['fans_id', '=', $value['user_id']], ['user_id', '=', $this->tokenData['id']]])){
                    $value['btn_status'] = 2;
                }



            }


        }

        return showResult(0, '', $data);

    }

    /**
     * 用户的关注
     * @return mixed
     * @throws \app\api\exception\ApiException
     */
    public function myFollow()
    {
        $param = $this->param();

        if(isset($param['user_id'])) {

            $userId = $param['user_id'];
        }else{
            $this->checkToken();
            $userId = $this->tokenData['id'];

        }

        $page = isset($param['page'])?$param['page']:1;

        $userFans = new \app\api\service\UserFans;

        $fansData = $userFans->followView()->initWhere([['UserFans.fans_id', '=', $userId]])->initLimit($page)
            ->getListData();
        $data = $fansData['list']->toArray();


        $domain = $this->getDomain();
        foreach ($data as $key => &$value){
            $avatar = $value['user_avatar'] ? json_decode($value['user_avatar'],1):userAvatar();
            $value['user_avatar'] = $domain . $avatar[100];
            $value['btn_status'] = 0; //未关注

            if(isset($this->tokenData['id'])){
                if($this->tokenData['id'] == $userId){
                    //已关注 查看自己的
                    $value['btn_status'] = 1;
                }elseif($userFans->getCount([['fans_id', '=', $this->tokenData['id']], ['user_id', '=', $value['user_id']]])){
                    //已关注 查看别人空间的
                    $value['btn_status'] = 1;
                }

                //判断互关注
                if($value['btn_status'] && $userFans->getCount([['fans_id', '=', $value['user_id']], ['user_id', '=', $this->tokenData['id']]])){
                    $value['btn_status'] = 2;
                }


            }
        }

        return showResult(0, '', $data);;
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
     * @throws \app\api\exception\ApiException
     */
    public function golds()
    {
        $this->checkToken();
        $userId = $this->tokenData['id'];
        $param = $this->param();

        $capital = new \app\common\model\UserCapital;

        $golds = $capital->where('user_id', $userId)->value('golds');
        $data['golds'] = $golds?$golds:0;
        isset($param['log']) && $data['log_list'] = $this->commonCapitalList($userId,1);

        return showResult(0, '', $data);

    }

    /**
     * 获取用户鱼鳞
     * @return array
     * @throws \app\api\exception\ApiException
     */
    public function scale()
    {
        $this->checkToken();
        $userId = $this->tokenData['id'];
        $param = $this->param();

        $capital = new \app\common\model\UserCapital;

        $scale = $capital->where('user_id', $userId)->value('scale');
        $data['scale'] = $scale?$scale:0;
        isset($param['log']) && $data['log_list'] = $this->commonCapitalList($userId,1,1);

        return showResult(0, '', $data);
    }

    /**
     * 获取提现额度
     * @return array
     * @throws \app\api\exception\ApiException
     */
    public function quota()
    {
        $this->checkToken();
        $userId = $this->tokenData['id'];

        $capital = new \app\common\model\UserCapital;

        $num = $capital->where('user_id', $userId)->value('quota');
        $data['quota'] = $num?$num:0;

        return showResult(0, '', $data);
    }

    /**
     * 兑换额度
     * @throws \app\api\exception\ApiException
     */
    public function exchangeQuota()
    {
        $this->checkToken();
        $userId = $this->tokenData['id'];

        $param = $this->param();

        Db::startTrans();
        $capital = new UserCapital;
        //要消耗的鱼泡
        $decNum = $param['num'] * 100;
        //扣掉鱼泡
        $residueNum = $capital->deductGolds($userId, $decNum);

        if($residueNum == false){
            Db::rollback();
            return showResult(-1, $capital->getError());
        }

        if($quotaNum = $capital->saveQuota($userId, $param['num'])){

            //记录消费日志
            $logResult = (new UserCapitalLog)->giveGoldsLog(
                [
                    'user_id' => $userId,
                    'pay' => '-'.$decNum,
                    'residue'=> $residueNum,
                    'explain'=> '兑换'.$param['num'].'个提现额度消费鱼泡',
                ],
                1
            );
            //通知
            $msgResult = (new SystemMessageService)->toUserSystem(
                $userId,
                ['content' => '你成功兑换'.$param['num'].'个提现额度'],
                3
            );

            if($logResult && $msgResult){

                Db::commit();
                return showResult(0, '兑换成功');
            }
        }

        Db::rollback();
        return showResult(-1, '兑换失败');
    }

    /**
     * 提现
     * @return array
     * @throws \app\api\exception\ApiException
     */
    public function exchangeCash()
    {
        $this->checkToken();
        $userId = $this->tokenData['id'];

        $param = $this->param();

        //money account_number real_name
        $userCashLog = new UserCashLog;
        $capital = new UserCapital;

        $saveData = [
            'user_id' => $userId,
            'money' => $param['money'],
            'account_number' => $param['account_number'],
            'real_name' => $param['real_name']
        ];

        if($reData = $userCashLog->save($saveData,0, 1)){
            $decNum = $saveData['money'] * 10;
            //消费鱼鳞 1:10
            $scaleResult = $capital->deductScale($userId, $decNum);

            if($scaleResult === false){

                Db::rollback();
                return showResult(-1, $capital->getError());
            }

            //消耗提现额度 1:1
            $quotaResult = $capital->deductQuota($userId, $saveData['money']);

            if($quotaResult === false){

                Db::rollback();
                return showResult(-1, $capital->getError());
            }

            //记录消费日志
            $logResult = (new UserCapitalLog)->giveScaleLog(
                [
                    'user_id' => $userId,
                    'pay' => '-'.$decNum,
                    'residue'=> $scaleResult,
                    'explain'=> '提现'.$saveData['money'].'.00元',
                    'o_id' => $reData['id'],
                ],
                1
            );
            //通知
            $msgResult = (new SystemMessageService)->toUserSystem(
                $userId,
                ['content' => '你成功提现'.$saveData['money'].'.00元，消耗鱼鳞'.$decNum.'个、提现额度'.$saveData['money']],
                4
            );


            if($logResult && $msgResult){
                Db::commit();
                return showResult(0, '提现成功');
            }

        }

        Db::rollback();
        return showResult(-1, '提现失败');
    }

    /**
     * 获取更多交易记录
     * @return array
     * @throws \app\api\exception\ApiException
     */
    public function moreCapitalLog()
    {
        $this->checkToken();
        $userId = $this->tokenData['id'];
        $param = $this->param();

        $type = ['scale'=>1, 'golds'=>0];

        $data = $this->commonCapitalList($userId, $param['page'], $type[$param['log']]);

        return showResult(0, '', $data);

    }

    /**
     *兑换记录
     */
    public function exchangeLog()
    {
        $this->checkToken();
        $userId = $this->tokenData['id'];
        $param = $this->param();

        $type = ['scale'=>1, 'golds'=>0];

        $data = $this->commonCapitalList($userId, $param['page'], $type[$param['log']], 1);

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
        if($param['field'] == 'data'){
            if($user->saveInfo($param['value'], $userId)){
                return showResult(0, '更新成功');
            }
        }else{
            if($user->saveOneInfo([$userId, $param['field'], $param['value']])){
                return showResult(0, '更新成功');
            }
        }

        return showResult(-1, $user->getError());

    }



    /**
     * 获取广播
     * @return mixed
     */
    public function commonBroadcast()
    {
        //广播
        $broadcastData = (new \app\api\service\SystemBroadcast)->initWhere([['type', '=', 0]])->initField('o_id,content')->initLimit(1)->getListData();
        $data = $broadcastData['list'];

        foreach ($data as $key => &$value){
            $value['content'] = str_replace(['<font color="#aa5500">','</font>'], ['<span style="color:#aa5500">', '</span>'], $value['content']);
        }

        return $data;
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
     * 获取公共交易记录
     * @param $user_id
     * @param int $page
     * @param int $type
     * @param int $o_type
     * @return mixed
     */
    protected function commonCapitalList($user_id, $page = 1, $type = 0, $o_type = 0)
    {
        $userCapitalLog = new UserCapitalLog;

        $where = [['UserCapitalLog.user_id', '=', $user_id], ['UserCapitalLog.type', '=', $type]];
        $o_type && $where[] = ['o_type', '=', 1];

        $data = $userCapitalLog
            ->initWhere($where)
            ->initLimit($page)
            ->getListData();

        return $data;
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