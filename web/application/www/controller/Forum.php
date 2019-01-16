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
        $this->getFormatUser($logic);
        $this->userFans($logic);
        $this->getFormatItem($logic);

        $data['post_list'] = $this->postList($logic);
        $data['seven_list'] = $logic->sevenDayHotData();
        $data['ad_banner'] = $logic->getBanner(5);

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

        $data['ad_banner'] = $logic->getBanner(6);

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
     * 展示用户个人信息
     * @param $logic
     * @return mixed
     */
    protected function getFormatUser($logic)
    {
        if($this->isFormat('show_user')){
            return $logic->formatUser();
        }
    }

    /**
     * 关注用户
     * @param $logic
     * @return mixed
     */
    protected function userFans($logic)
    {
        if($this->isFormat('fans')) {
            return $logic->userFans();
        }
    }

    /**
     * 加载帖子详情
     * @param $logic
     * @return mixed
     */
    protected function getFormatItem($logic)
    {
        if($this->isFormat('item')) {
            return $logic->formatItem();
        }
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
        if($this->isFormat('praise')){
            return $logic->formatPraise();
        }

    }

    /**
     * 评论
     * @param $logic
     * @return mixed
     */
    protected function comment($logic)
    {
        if($this->isFormat('comment')) {
            return $logic->formatComment();
        }
    }

    /**
     * 回复评论
     * @param $logic
     * @return mixed
     */
    protected function replyComment($logic)
    {
        if($this->isFormat('reply_comment')) {
            return $logic->formatReplyComment();
        }
    }

    /**
     * 评论点赞
     * @param $logic
     * @return mixed
     */
    protected function commentPraise($logic)
    {
        if($this->isFormat('comment_praise')){
            return $logic->formatCommentPraise();
        }
    }

    /**
     * 评论踩踏
     * @param $logic
     * @return mixed
     */
    protected function commentTread($logic)
    {
        if($this->isFormat('comment_tread')){
            return $logic->formatCommentTread();
        }
    }

}