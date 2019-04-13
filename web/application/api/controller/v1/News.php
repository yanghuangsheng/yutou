<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/13
 * Time: 14:20
 */

namespace app\api\controller\v1;

use \app\api\logic\News as Logic;

class News extends Base
{
    //新闻列表
    public function index()
    {
        $data = (new Logic)->loadList();

        return showResult(0, '', $data['list']);
    }

    //新闻详情
    public function item()
    {
        $logic = new Logic;
        $comment = $logic->getCommentList();

        $data['item'] = $logic->getItem();
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
     * 查看评论
     * @return array
     */
    public function lookComment()
    {
        return (new Logic)->getLookCommentList();
    }

    /**
     * 评论
     * @return array
     */
    public function submitComment()
    {
        return (new Logic)->addComment();

    }

    /**
     * 点赞新闻
     * @return mixed
     */
    public function praise()
    {
        return (new Logic)->praiseNews();
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