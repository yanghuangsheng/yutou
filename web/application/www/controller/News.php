<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/13
 * Time: 17:00
 */

namespace app\www\controller;

use \app\www\logic\News as newsLogic;


class News extends Base
{
    /**
     * 新闻详情页
     */
    public function item()
    {
        $logic = new newsLogic;
        $this->praise($logic);
        $this->comment($logic);
        $this->replyComment($logic);
        $this->commentPraise($logic);
        $this->commentTread($logic);


        $data['item'] = $logic->getItem();
        $data['comment_new'] = $this->commentList($logic);
        //7天热门
        $data['seven_list'] = $logic->sevenDayHotData();
        $data['related'] = $logic->relatedData($logic);
        //右侧广告
        $data['ad_banner'] = $logic->getBanner(4);

        $this->init(['title'=>$data['item']['title']]);
        $this->assign('data', $data);

        return $this->fetch();
    }



    /**
     * 评论列表
     * @param $logic
     * @return mixed
     */
    public function commentList($logic)
    {
        return $logic->getCommentList();
    }

    /**
     * 点赞
     * @param $logic
     * @return mixed
     */
    protected function praise($logic)
    {
        return $logic->formatPraise();
    }

    /**
     * 评论
     * @param $logic
     * @return mixed
     */
    protected function comment($logic)
    {
        return $logic->formatComment();
    }

    /**
     * 回复评论
     * @param $logic
     * @return mixed
     */
    protected function replyComment($logic)
    {
         return $logic->formatReplyComment();
    }

    /**
     * 评论点赞
     * @param $logic
     * @return mixed
     */
    protected function commentPraise($logic)
    {
        return $logic->formatCommentPraise();
    }

    /**
     * 评论踩踏
     * @param $logic
     * @return mixed
     */
    protected function commentTread($logic)
    {
        return $logic->formatCommentTread();
    }
}