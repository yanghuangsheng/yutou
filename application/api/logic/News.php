<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/18
 * Time: 17:55
 */

namespace app\api\logic;

use app\api\exception\ErrorException;
use app\api\exception\SuccessException;
use app\api\service\PortalNews;
use app\api\service\PortalNewsCommentClick;
use app\api\service\PortalNewsPraise;
use app\api\service\UserCollection;
use app\api\service\MatchSupport;
use app\api\service\UserTask;
use think\Exception;

class News extends Base
{
    /**
     * 获取列表
     * @param $category_id
     * @return mixed
     */
    public function getList($category_id)
    {
        $param = $this->param();
        isset($param['page']) || $param['page'] = 1;

        $service = new PortalNews;
        $categoryList[] = $category_id;
        $where = [
            ['PortalNews.status', '=', 1],
        ];

        $category_id && $where[] = ['PortalNewsInCategory.category_id', 'in', join(',', $categoryList)];

        isset($param['start_id']) && $where[] = ['PortalNews.id', '<=', $param['start_id']];

        $data = $service->initWhere($where)->initLimit($param['page'])->getListData();

        $data['list'] = $data['list']->toArray();
        $domain = $this->getDomain();

        foreach ($data['list'] as $key => &$value){
            $value['image_url'] = $domain.$value['image_url'];
            $value['description'] = clean_html($value['description'], 60);
            $value['published_time'] = friendlyDate($value['published_time']);

        }
        $data['category'] = $category_id;

        return $data;
    }

    /**
     * 加载更多
     * @throws SuccessException
     */
    public function loadList()
    {
        $categoryId = $this->param('category_id');
        $data = $this->getList($categoryId);

        throw new SuccessException('success', $data['list']);
    }

    /**
     * 首页快讯
     * @return array|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function sevenDayTopData()
    {
        return (new PortalNews)->hotData(30, 10, [['PortalNews.recommended','=',1]]);
    }

    /**
     * 获取新闻详情
     * @throws SuccessException
     */
    public function getItem()
    {
        $newsId = $this->param('id');
        $domain = $this->getDomain();
        $service = new PortalNews;
        $data = $service->getOneData($newsId);

        $data['image_url'] = $domain.$data['image_url'];

        $data['attr_data'] = $data['attr_data']?json_decode($data['attr_data'], 1):[];
        $data['main_image_url'] = $data['main_image_url']?$domain.$data['main_image_url']:'';
        $data['passenger_image_url'] = $data['passenger_image_url']?$domain.$data['passenger_image_url']:'';

        $data['published_time_txt'] = date('Y-m-d H:i', $data['published_time']);
        $data['content'] = $this->ruleImg($data['content']);
        $data['is_praise'] = 0;
        $data['is_collect'] = 0;
        $data['user_support_status'] = '';
        $data['is_task'] = 0;

        if(isset($this->tokenData['id'])){
            $data['is_praise'] = (new PortalNewsPraise)->getCount([['news_id', '=', $data['id']], ['user_id', '=', $this->tokenData['id']]]);
            $data['is_collect'] = (new UserCollection)->getCount([['o_id', '=', $data['id']],['type', '=', 0],['user_id', '=', $this->tokenData['id']]]);
            $data['user_support_status'] = (new MatchSupport)->getField([['user_id', '=', $this->tokenData['id']]], 'support_status');
            $data['is_task'] = (new UserTask)->checkTask($this->tokenData['id'], 'news_browse', $data['id']);
        }


        //更新浏览量
        $browseNum = (new \app\www\service\PortalNewsAttr)->saveNum(['id'=>$newsId], 'browse');
        //规则触发
        $this->ruleTrigger('browse_num', ['id'=>$newsId, 'num'=>$browseNum]);

        $resultData['item'] = $data;


        $comment = $this->getCommentList();
        $resultData['start_id'] = $comment['start_id'];
        $resultData['new_comment_list'] = $comment['list'];
        $resultData['hot_comment_list'] = [];

        throw new SuccessException('success', $resultData);

    }

    /**
     * 更新每日任务
     * @throws SuccessException
     * @throws \app\api\exception\ErrorException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function updateTask()
    {
        $this->checkToken();
        $param = $this->param();
        $id = $param['id'];

        $data = (new UserTask)->updateTaskStatus($this->tokenData['id'], 'news_browse', $id);

        throw new SuccessException('success', $data);
    }

    /**
     * 新闻评论
     * @return mixed
     */
    public function getCommentList()
    {
        $newsId = $this->param('id');
        $comment = new \app\api\service\PortalNewsComment;

        $data = $this->getCommonCommentList($comment, [['PortalNewsComment.news_id', '=', $newsId]]);

        $data['start_id'] = $comment->newsId();
        return $data;
    }

    /**
     * 加载更多评论
     * @throws SuccessException
     */
    public function getMoreCommentList()
    {
        $param = $this->param();
        //检测 $id $page $start_id 必须参数

        $comment = new \app\api\service\PortalNewsComment;

        $data = $this->getCommonCommentList(
            $comment,
            [['PortalNewsComment.news_id', '=', $param['id']], ['PortalNewsComment.id', '<=', $param['start_id']]],
            $param['page']
        );

        throw new SuccessException('success', $data['list']);
    }

    /**
     * 指定获取评论ID
     * @param $comment
     * @param $where
     * @param $page
     * @return mixed
     */
    public function getCommonCommentList($comment, $where, $page = 1)
    {
        $praise = new PortalNewsCommentClick;
        $data = $comment
            //->initWhere([['PortalNewsComment.news_id', '=', $newsId]])
            ->initWhere($where)
            ->initLimit($page)
            ->getListData();

        $domain = $this->getDomain();
        $data['list'] = $data['list']->toArray();
        foreach ($data['list'] as $key => &$value){
            foreach ($value['user_avatar'] as $keys => $values){
                $value['user_avatar'][$keys] = $domain.$values;
            }
            foreach ($value['reply_avatar'] as $keys => $values){
                $value['reply_avatar'][$keys] = $domain.$values;
            }

            $value['is_praise'] = 0;
            if(isset($this->tokenData['id'])){
                $value['is_praise'] = $praise->getCount([['comment_id', '=', $value['id']], ['user_id', '=', $this->tokenData['id']], ['type', '=', 0]]);
            }

        }

        return $data;
    }

    /**
     * 获取查看评论
     * @throws SuccessException
     */
    public function getLookCommentList()
    {
        $param = $this->param();
        //提交数据验证 -> 暂缺

        $comment = new \app\api\service\PortalNewsComment;
        //返回评论内容
        $itemData = $this->getCommonCommentList($comment, [['PortalNewsComment.id', '=', $param['id']]]);
        $listData = $this->getCommonCommentList($comment, [['PortalNewsComment.reply_id', '=', $param['id']]]);
        $data = [
            'item' => $itemData['list'][0], //主评论内容
            'list' => $listData['list'], //所有回复的评论
        ];

        throw new SuccessException('success', $data);
    }

    /**
     * 评论新闻
     * @throws ErrorException
     * @throws SuccessException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function addComment()
    {

        $this->checkToken();
        $param = $this->param();
        //提交数据验证 -> 暂缺


        $comment = new \app\api\service\PortalNewsComment;
        //用户ID
        $param['user_id'] = $this->tokenData['id'];
        $param['content'] = (new Face)->ruleFace($param['content']);

        if($result = $comment->addComment($param)){

            //累加新闻评论数
            $commentNum = (new \app\api\service\PortalNewsAttr)->saveNum($param, 'comment');

            //规则触发
            $this->ruleTrigger('comment_num', ['id'=>$param['id'], 'num'=>$commentNum]);

            //更新评论用户的评论数
            (new \app\api\service\UserAttr)->saveNum(['id'=>$param['user_id']], 'comment');

            //返回评论内容
            $where = [
                ['PortalNewsComment.news_id', '=', $result['news_id']],
                ['PortalNewsComment.id', '=', $result['id']]
            ];
            $comment_data = $this->getCommonCommentList($comment, $where);

            //更新评论任务
            $data['list'] = $comment_data['list'];
            $data['task_data'] = (new UserTask)->updateTaskStatus($param['user_id'], 'news_comment', $result['news_id']);

            throw new SuccessException('评论成功', $data);
        }

        throw new ErrorException('评论失败');
    }

    /**
     * 收藏新闻
     * @throws ErrorException
     * @throws SuccessException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function collect()
    {
        $this->checkToken();

        $param = $this->param();
        $newsId = $param['id'];
        $userId = $this->tokenData['id'];

        $data = [
            'id' => $newsId,
            'user_id' => $userId,
            'type' => 0

        ];

        $collect = new \app\api\service\UserCollection;
        if(false == $collect->addCollect($data)){

            throw new ErrorException($collect->getError());
        }

        $newsAttr = new \app\api\service\PortalNewsAttr;
        if($collectNum = $newsAttr->saveNum($data, 'collect')){
            //触发规则
            $this->ruleTrigger('collect_num', ['id'=>$newsId, 'num'=>$collectNum]);
            //更新点赞任务
            $data = (new UserTask)->updateTaskStatus($userId, 'news_collect', $newsId);

            throw new SuccessException('收藏成功', $data);
        }

        throw new ErrorException('收藏失败');

    }

    /**
     * 点赞新闻
     * @throws ErrorException
     * @throws SuccessException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function praiseNews()
    {
        $this->checkToken();

        $param = $this->param();
        $newsId = $param['id'];
        $userId = $this->tokenData['id'];
        $praise = new \app\api\service\PortalNewsPraise;
        if(false == $praise->addUserPraise(['news_id'=>$newsId, 'user_id'=>$userId])){

            throw new ErrorException($praise->getError());
        }
        $newsAttr = new \app\api\service\PortalNewsAttr;
        if($praiseNum = $newsAttr->saveNum($param, 'praise')){

            //规则触发
            $this->ruleTrigger('praise_num', ['id'=>$newsId, 'num'=>$praiseNum]);
            //更新点赞任务
            $data = (new UserTask)->updateTaskStatus($userId, 'news_praise', $newsId);

            throw new SuccessException('点赞成功', $data);
        }

        throw new ErrorException('点赞失败');
    }

    /**
     * 点赞评论
     * @throws ErrorException
     * @throws SuccessException
     */
    public function praiseComment()
    {
        $this->checkToken();
        $param = $this->param();
        //提交数据验证 -> 暂缺

        $praise = new \app\api\service\PortalNewsCommentClick;
        //用户ID
        $param['user_id'] = $this->tokenData['id'];
        if($praise->savePraise($param)){
            (new \app\api\service\PortalNewsCommentAttr)->saveNum(['id'=>$param['id']] ,'praise');
            //更新评论用户的点赞数
            $userId = (new \app\api\service\PortalNewsComment)->getField($param['id'], 'user_id');
            (new \app\api\service\UserAttr)->saveNum(['id'=>$userId], 'praise');

            throw new SuccessException('点赞成功');
        }

        throw new ErrorException($praise->getError()?$praise->getError():'点赞失败');
    }

    /**
     * 获取最新的ID
     * @return mixed
     */
    public function getNewsId()
    {
        $service = new PortalNews;

        return $service->newsId();
    }

    /**
     * 规则触发器
     * @param $event 事件
     * @param $dara ['id','num']
     */
    protected function ruleTrigger($event, $dara){
        (new \app\api\service\PortalNewsRule)->trigger($event, $dara);
    }


}