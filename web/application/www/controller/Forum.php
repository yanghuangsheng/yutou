<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/16
 * Time: 10:31
 */

namespace app\www\controller;

use \app\www\logic\Forum as Logic;

class Forum extends Base
{
    /**
     * 论坛首页
     */
    public function index()
    {
        $logic = new Logic;
        $this->getFormatPost($logic);

        $data['post_list'] = $this->postList($logic);
        $data['seven_list'] = $logic->sevenDayHotData();
        //print_r($data['seven_list']);

        $this->assign('data',$data);
        return $this->fetch();
    }

    /**
     * 论坛帖子
     */
    public function item()
    {
        $logic = new Logic;
        $this->praise($logic);
        $this->comment($logic);
        $this->replyComment($logic);
        $this->commentPraise($logic);
        $this->commentTread($logic);
        $this->userFans($logic);
        $this->collect($logic);


        $data['item'] = $logic->getItem();
        $data['comment_new'] = $this->commentList($logic);
        //7天热门
        $data['seven_list'] = $logic->sevenDayHotData();
        $data['related'] = $logic->relatedData($logic);

        $this->assign('data', $data);

        return $this->fetch();
    }

    /**
     * 加载更多帖子
     * @param $logic
     * @return mixed
     */
    protected function getFormatPost($logic)
    {
        if($this->isFormat('post')){
            return $logic->formatPost();
        }
    }

    /**
     * 关注用户
     * @param $logic
     * @return mixed
     */
    protected function userFans($logic)
    {
        return $logic->userFans();
    }

    /**
     * 收藏
     */
    protected function collect($logic)
    {
        $logic->collect();
    }


    /**
     * 新闻列表
     * @param $logic
     * @return array
     */
    protected function postList($logic)
    {
        $data['data'][] = $logic->getList('hot'); //热门
        $data['data'][] = $logic->getList('new'); //最新
        $data['start_id'] =  $logic->getNewsId(); //用于获取下一页数据，预防有新数据重复出现
        return $data;
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