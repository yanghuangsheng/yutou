<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/25
 * Time: 13:52
 */

namespace app\www\logic;

use \app\www\service\News as newsService;

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

        $service = new newsService;
        $categoryList[] = $category_id;
        $where = [
            ['PortalNews.status', '=', 1],
            ['PortalNewsInCategory.category_id', 'in', join(',', $categoryList)]
        ];
        isset($param['start_id']) && $where[] = ['PortalNews.id', '<=', $param['start_id']];

        $data = $service->initWhere($where)->initLimit($param['page'])->getListData();

        $data['list'] = $data['list']->toArray();
        foreach ($data['list'] as $key => &$value){
            $value['description'] = clean_html($value['description'], 60);
            $value['published_time'] = date('Y-m-d H:i', $value['published_time']);

        }
        $data['category'] = $category_id;

        return $data;
    }

    /**
     * 首页置顶资讯
     * @return mixed
     */
    public function sevenDayTopData()
    {
        return (new newsService)->hotData(20, 3, [['PortalNews.top','=',1]]);
    }

    /**
     * 7天热门资讯
     * @return mixed
     */
    public function sevenDayHotData()
    {
        return (new newsService)->hotData();
    }

    /**
     * 彩票最新开奖列表
     */
    public function lotteryList()
    {
        return (new \app\www\service\Lottery)->allList();
    }

    /**
     * 上一篇 下一篇
     * @return mixed
     */
    public function relatedData()
    {
        return (new newsService)->relatedData($this->param('id'));
    }


    /**
     * 获取新闻详情
     * @return mixed
     */
    public function getItem()
    {
        $newsId = $this->param('id');
        if($newsId == '' || !is_numeric($newsId)){
            exception('页面不存在', 404);
        }

        $service = new newsService;
        $data = $service->getOneData($newsId);

        //更新浏览量
        (new \app\www\service\PortalNewsAttr)->saveNum(['id'=>$newsId], 'browse');

        return $data;

    }

    /**
     * 收藏新闻
     */
    public function collect()
    {

        if($this->isAjax() && $this->isPost() && $this->param('_format_') == 'collect') {
            $param = $this->param();
            $data = [
                'id' => $param['id'],
                'user_id' => $this->session('user')['id'],
                'type' => 0

            ];
            $collect = new \app\www\service\UserCollection;
            if(false == $collect->addCollect($data)){
                $this->resultJson(-1, '收藏失败');
            }
            $this->resultJson(0, '收藏成功');
        }
    }

    /**
     * 新闻评论
     * @return mixed
     */
    public function getCommentList()
    {
        $newsId = $this->param('id');
        $comment = new \app\www\service\PortalNewsComment;
        $newestId = $comment->newsId();
        $data = $comment
            ->initWhere([['PortalNewsComment.news_id', '=', $newsId], ['PortalNewsComment.parent_id', '=', 0]])
            ->getListData();
        foreach ($data['list'] as $key => &$value){
            $value['user_avatar'] = json_decode($value['user_avatar'], true);
            $value['comment_list'] = $comment
                ->initWhere([['PortalNewsComment.news_id', '=', $newsId], ['PortalNewsComment.parent_id', '=', $value['id']]])
                ->getListData();
            $commentData = $value['comment_list'];
            foreach ($commentData['list'] as $key1 => &$value1){
                $value1['user_avatar'] = json_decode($value1['user_avatar'], true);
                $value1['reply_avatar'] = json_decode($value1['reply_avatar'], true);
            }
            $value['comment_list'] = $commentData;
        }
        //print_r($data);
        return $data;
    }

    /**
     * 加载更多新闻
     */
    public function formatNews()
    {
        if($this->isAjax()){
            $categoryId = $this->param('category_id');
            $data = $this->getList($categoryId);

            $this->resultJson(0, '', $data);

        }

    }

    /**
     * 点赞
     */
    public function formatPraise()
    {
        if($this->isAjax() && $this->isPost() && $this->param('_format_') == 'praise'){
            $param = $this->param();
            $praise = new \app\www\service\PortalNewsPraise;
            if(false == $praise->addUserPraise(['news_id'=>$param['id'], 'user_id'=>$this->session('user')['id']])){
                $this->resultJson(-1, $praise->getError());
            }
            if($data = (new \app\www\service\PortalNewsAttr)->saveNum($param, 'praise')){
                $this->resultJson(0, '点赞成功');
            }

            $this->resultJson(-1, '点赞失败');
        }
    }

    /**
     * 评论
     */
    public function formatComment()
    {
        if($this->isAjax() && $this->isPost() && $this->param('_format_') == 'comment'){

            $param = $this->param();
            //提交数据验证 -> 暂缺


            $comment = new \app\www\service\PortalNewsComment;
            //用户ID
            $param['user_id'] = $this->session('user')['id'];
            if($comment->addComment($param)){
                (new \app\www\service\PortalNewsAttr)->saveNum($param, 'comment');
                //更新评论用户的评论数
                (new \app\www\service\UserAttr)->saveNum(['id'=>$param['user_id']], 'comment');

                $this->resultJson(0, '评论成功');
            }

            $this->resultJson(-1, '评论失败');
        }
    }

    /**
     * 回复评论
     */
    public function formatReplyComment()
    {
        if($this->isAjax() && $this->isPost() && $this->param('_format_') == 'reply_comment') {
            $param = $this->param();
            //提交数据验证 -> 暂缺

            $comment = new \app\www\service\PortalNewsComment;
            //用户ID
            $param['user_id'] = $this->session('user')['id'];
            if($comment->addReplyComment($param)){

                $this->resultJson(0, '评论成功');
            }

            $this->resultJson(-1, '评论失败');
        }
    }

    /**
     * 评论点赞
     */
    public function formatCommentPraise()
    {
        if($this->isAjax() && $this->isPost() && $this->param('_format_') == 'comment_praise') {
            $param = $this->param();
            //提交数据验证 -> 暂缺



            $praise = new \app\www\service\PortalNewsCommentClick;
            //用户ID
            $param['user_id'] = $this->session('user')['id'];
            if($praise->savePraise($param)){
                (new \app\www\service\PortalNewsCommentAttr)->saveNum(['id'=>$param['id']] ,'praise');
                //更新评论用户的点赞数
                $userId = (new \app\www\service\PortalNewsComment)->getField($param['id'], 'user_id');
                (new \app\www\service\UserAttr)->saveNum(['id'=>$userId], 'praise');

                $this->resultJson(0, '点赞成功');
            }

            $this->resultJson(-1, $praise->getError()?$praise->getError():'点赞失败');

        }
    }

    /**
     * 评论踩踏
     */
    public function formatCommentTread()
    {
        if($this->isAjax() && $this->isPost() && $this->param('_format_') == 'comment_tread') {
            $param = $this->param();
            //提交数据验证 -> 暂缺


            $praise = new \app\www\service\PortalNewsCommentClick;
            //用户ID
            $param['user_id'] = $this->session('user')['id'];
            if($praise->saveTread($param)){
                (new \app\www\service\PortalNewsCommentAttr)->saveNum(['id'=>$param['id']] ,'tread');
                //更新评论用户的点赞数
                $userId = (new \app\www\service\PortalNewsComment)->getField($param['id'], 'user_id');
                (new \app\www\service\UserAttr)->saveNum(['id'=>$userId], 'tread');

                $this->resultJson(0, '踩踏成功');
            }

            $this->resultJson(-1, $praise->getError()?$praise->getError():'踩踏失败');
        }
    }



    /**
     * 获取最新的ID
     * @return mixed
     */
    public function getNewsId()
    {
        $service = new newsService;

        return $service->newsId();
    }



}