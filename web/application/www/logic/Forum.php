<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/28
 * Time: 16:36
 */

namespace app\www\logic;

use \app\www\service\ForumPost;

class Forum extends Base
{
    /**
     * 获取列表
     * @param string $type new最新 hot热门
     * @return mixed
     */
    public function getList($type = 'new')
    {
        $param = $this->param();
        isset($param['page']) || $param['page'] = 1;

        $service = new ForumPost;
        $where[] = ['ForumPost.status', '=', 1];
        if($type == 'hot'){
            $where[] = ['ForumPost.hot', '=', 1];
        }

        isset($param['start_id']) && $where[] = ['ForumPost.id', '<=', $param['start_id']];

        $data = $service->initWhere($where)->initLimit($param['page'])->getListData();

        $data['list'] = $data['list']->toArray();
        foreach ($data['list'] as $key => &$value){
            $value['description'] = clean_html($value['content'], 60);
            $value['user_avatar'] = json_decode($value['user_avatar'], true);

        }
        $data['type'] = $type;

        return $data;
    }

    /**
     * 加载更多帖子列表
     */
    public function formatPost()
    {
        if($this->isAjax()){
            $type = $this->param('type');
            $data = $this->getList($type);

            $this->resultJson(0, '', $data);

        }
    }

    /**
     * 发布帖子
     */
    public function pubPost()
    {
        if ($this->isAjax() && $this->isPost() && $this->param('_format_') == 'pub_post') {
            $param = $this->param();
            //提交数据验证 -> 暂缺

            $forum = new ForumPost;
            //用户ID
            $param['user_id'] = $this->session('user')['id'];
            $param['status'] = 1;
            if($forum->save($param)){
                (new \app\www\service\UserAttr)->saveNum(['id'=>$param['user_id']], 'post');
                $this->resultJson(0, '发布成功');
            }

            $this->resultJson(-1, $forum->getError()?$forum->getError():'发布失败');
        }
    }


    /**
     * 上传图片
     * @param $path
     * @param array $size
     */
    public function uploadImage($path = 'cover', $size = [218, 129])
    {
        $upload = new \app\www\service\Upload;
        $data = $upload->upFile('forum_'.$path);

        if (isset($data['error'])) {
            $this->resultJson(-1, $data['error']);
        }
        else{
            //压缩图片
            resultThumb($data['file'], 'no', $size[0], $size[1], 0);
            $this->resultJson(0, '上传成功', ['image_url'=> $data['file'], 'tmp_name'=> $data['tmp_name']]);
        }
    }



    /**
     * 7天热门资讯
     * @return mixed
     */
    public function sevenDayHotData()
    {
        return (new ForumPost)->hotData();
    }

    /**
     * 上一篇 下一篇
     * @return mixed
     */
    public function relatedData()
    {
        return (new ForumPost)->relatedData($this->param('id'));
    }


    /**
     * 获取帖子详情
     * @return mixed
     */
    public function getItem()
    {
        $postId = $this->param('id');
        if($postId == '' || !is_numeric($postId)){
            exception('页面不存在', 404);
        }

        $service = new ForumPost;
        $data = $service->getOneData($postId);
        $data['collect'] = 0;
        //关注情况
        if(isset($this->session('user')['id'])){
            $data['collect'] = (new \app\www\service\UserFans)->checkFans($data['user_id'], $this->session('user')['id']);
        }

        //更新浏览量
        (new \app\www\service\ForumPostAttr)->saveNum(['id'=>$postId], 'browse');

        return $data;

    }

    /**
     * 帖子评论
     * @return mixed
     */
    public function getCommentList()
    {
        $postId = $this->param('id');
        $comment = new \app\www\service\ForumPostComment;
        $newestId = $comment->newsId();
        $data = $comment
            ->initWhere([['ForumPostComment.post_id', '=', $postId], ['ForumPostComment.parent_id', '=', 0]])
            ->getListData();
        foreach ($data['list'] as $key => &$value){
            $value['user_avatar'] = json_decode($value['user_avatar'], true);
            $value['comment_list'] = $comment
                ->initWhere([['ForumPostComment.post_id', '=', $postId], ['ForumPostComment.parent_id', '=', $value['id']]])
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
     * 加载更多帖子
     */
    public function formatNews()
    {
        if($this->isAjax()){
            $type = $this->param('type');
            $data = $this->getList($type);

            $this->resultJson(0, '', $data);

        }

    }

    /**
     * 收藏帖子
     */
    public function collect()
    {

        if($this->isAjax() && $this->isPost() && $this->param('_format_') == 'collect') {
            $param = $this->param();
            $data = [
                'id' => $param['id'],
                'user_id' => $this->session('user')['id'],
                'type' => 1

            ];
            $collect = new \app\www\service\UserCollection;
            if($collect->addCollect($data)){
                (new \app\www\service\ForumPostAttr)->saveNum($param, 'collect');
                $this->resultJson(0, '收藏成功');
            }
            $this->resultJson(-1, $collect->getError()?$collect->getError():'收藏失败');
        }
    }

    /**
     * 关注用户
     */
    public function userFans()
    {
        if($this->isAjax() && $this->isPost() && $this->param('_format_') == 'fans'){
            $param = $this->param();
            $userFans = new \app\www\service\UserFans;
            if(false == $userFans->addFans(['id'=>$param['user_id'], 'user_id'=>$this->session('user')['id']])){
                $this->resultJson(-1, '关注失败');
            }
            $this->resultJson(0, '关注成功');

        }
    }

    /**
     * 点赞
     */
    public function formatPraise()
    {
        if($this->isAjax() && $this->isPost() && $this->param('_format_') == 'praise'){
            $param = $this->param();
            $praise = new \app\www\service\ForumPostPraise;
            if(false == $praise->addUserPraise(['post_id'=>$param['id'], 'user_id'=>$this->session('user')['id']])){
                $this->resultJson(-1, $praise->getError());
            }
            if($data = (new \app\www\service\ForumPostAttr)->saveNum($param, 'praise')){
                //更新评论用户的点赞数
                $userId = (new \app\www\service\ForumPost)->getField($param['id'], 'user_id');
                (new \app\www\service\UserAttr)->saveNum(['id'=>$userId], 'praise');
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


            $comment = new \app\www\service\ForumPostComment;
            //用户ID
            $param['user_id'] = $this->session('user')['id'];
            if($comment->addComment($param)){
                (new \app\www\service\ForumPostAttr)->saveNum($param, 'comment');
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

            $comment = new \app\www\service\ForumPostComment;
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



            $praise = new \app\www\service\ForumPostCommentClick;
            //用户ID
            $param['user_id'] = $this->session('user')['id'];
            if($praise->savePraise($param)){
                (new \app\www\service\ForumPostCommentAttr)->saveNum(['id'=>$param['id']] ,'praise');
                //更新评论用户的点赞数
                $userId = (new \app\www\service\ForumPostComment)->getField($param['id'], 'user_id');
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


            $praise = new \app\www\service\ForumPostCommentClick;
            //用户ID
            $param['user_id'] = $this->session('user')['id'];
            if($praise->saveTread($param)){
                (new \app\www\service\ForumPostCommentAttr)->saveNum(['id'=>$param['id']] ,'tread');
                //更新评论用户的点赞数
                $userId = (new \app\www\service\ForumPostComment)->getField($param['id'], 'user_id');
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
        $service = new ForumPost;

        return $service->newsId();
    }


}