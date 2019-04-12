<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/13
 * Time: 17:31
 */

namespace app\api\controller\v1;

use \app\api\logic\Forum as Logic;

class Forum extends Base
{
    //社区所有
    public function index()
    {
        $forum = new Logic;
        $data['data'][] = $forum->getList('hot'); //热门
        $data['data'][] = $forum->getList('new'); //最新
        $data['start_id'] =  $forum->getNewsId(); //用于获取下一页数据，预防有新数据重复出现

        return showResult(0, '', $data);

    }

    //加载更多
    public function loadList()
    {
        $forum = new Logic;
        $data = $forum->gitLoadList();

        return showResult(0, '', $data);
    }

    //帖子详情
    public function item()
    {
        $forum = new Logic;

        $comment = $forum->getCommentList();

        $data['item'] = $forum->getItem();
        $data['start_id'] = $comment['start_id'];
        $data['new_comment_list'] = $comment['list'];
        $data['hot_comment_list'] = [];

        return showResult(0, '', $data);
    }

    /**
     * 加载更多
     * @return array
     */
    public function moreComment()
    {
        return (new Logic)->getMoreCommentList();
    }

    /**
     * 评论
     * @return array
     */
    public function submitComment()
    {
        return (new Logic)->submitComment();

    }

    /**
     * 点赞新闻
     * @return mixed
     */
    public function praise()
    {
        return (new Logic)->praisePost();
    }

    /**
     * 点赞评论
     * @return array
     */
    public function praiseComment()
    {
        return (new Logic)->praiseComment();
    }




}