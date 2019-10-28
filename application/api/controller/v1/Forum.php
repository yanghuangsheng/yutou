<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/13
 * Time: 17:31
 */

namespace app\api\controller\v1;

use \app\api\logic\Forum as Logic;
use \app\api\exception\SuccessException;

class Forum extends Base
{

    /**
     * 社区首页
     * @throws SuccessException
     */
    public function index()
    {
        $forum = new Logic;
        $data['data'][] = $forum->getList('hot'); //热门
        $data['data'][] = $forum->getList('new'); //最新
        $data['start_id'] =  $forum->getNewsId(); //用于获取下一页数据，预防有新数据重复出现

        throw new SuccessException('success', $data);

    }

    /**
     * 加载更多
     * @throws SuccessException
     */
    public function loadList()
    {
        $forum = new Logic;
        $data = $forum->gitLoadList();

        throw new SuccessException('success', $data);
    }

    /**
     * 热门话题
     * @throws SuccessException
     */
    public function hotTopic()
    {
        (new Logic)->sevenDayHotTopic();
    }

    /**
     * 帖子详情
     * @throws SuccessException
     */
    public function item()
    {
        $forum = new Logic;

        $comment = $forum->getCommentList();

        $data['item'] = $forum->getItem();
        $data['start_id'] = $comment['start_id'];
        $data['new_comment_list'] = $comment['list'];
        $data['hot_comment_list'] = [];

        throw new SuccessException($data);

    }

    /**
     * 加载更多
     * @throws SuccessException
     */
    public function moreComment()
    {
        (new Logic)->getMoreCommentList();
    }

    /**
     * 加载更多
     * @throws SuccessException
     */
    public function lookComment()
    {
        (new Logic)->getLookCommentList();
    }

    /**
     * 评论
     * @throws SuccessException
     * @throws \app\api\exception\ErrorException
     */
    public function submitComment()
    {
        (new Logic)->submitComment();

    }

    /**
     * 点赞新闻
     * @throws SuccessException
     * @throws \app\api\exception\ErrorException
     */
    public function praise()
    {
        (new Logic)->praisePost();
    }

    /**
     * 点赞评论
     * @throws SuccessException
     * @throws \app\api\exception\ErrorException
     */
    public function praiseComment()
    {
        (new Logic)->praiseComment();
    }




}