<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/22
 * Time: 16:30
 */

namespace app\api\logic;

use \app\api\service\ForumPost;

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
            foreach ($value['user_avatar'] as $key1 => &$value1){
                $value1 = $this->getDomain().$value1;
            }
            foreach ($value['image_url'] as $key1 => &$value1){
                $value1 = $this->getDomain().$value1;
            }

        }
        $data['type'] = $type;

        return $data;
    }

    /**
     * 加载更多帖子列表
     */
    public function gitLoadList()
    {
        $type = $this->param('type');
        $data = $this->getList($type);

        return $data;

    }

    /**
     * 获取帖子详情
     * @return mixed
     */
    public function getItem()
    {
        $postId = $this->param('id');

        $service = new ForumPost;
        $data = $service->getOneData($postId);
        $domain = $this->getDomain();
        $data['user_avatar'] = $domain . $data['user_avatar'][100];

        $data['collect'] = 0;
        //关注情况
        if(isset($this->tokenData['id'])){
            $data['collect'] = (new \app\api\service\UserFans)->checkFans($data['user_id'], $this->tokenData['id']);
        }

        //更新浏览量
        $browseNum = (new \app\api\service\ForumPostAttr)->saveNum(['id'=>$postId], 'browse');
        //广播
        $tokenName = isset($this->tokenData['name'])?$this->tokenData['name']:'鱼妹';
        (new \app\api\service\SystemBroadcast)->trigger(1, 'browse_num', ['name'=>$tokenName, 'id'=>$postId, 'title'=>$data['title'], 'num'=>$browseNum]);
        //规则触发
        $this->ruleTrigger('browse_num', ['id'=>$postId, 'num'=>$browseNum]);

        return $data;

    }


    /**
     * 帖子评论
     * @return mixed
     */
    public function getCommentList()
    {
        $id = $this->param('id');
        $comment = new \app\api\service\ForumPostComment;

        $data = $this->getCommonCommentList($comment, [['ForumPostComment.post_id', '=', $id]]);

        $data['start_id'] = $comment->newsId();
        return $data;
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
        $data = $comment
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

        }

        return $data;
    }


    /**
     * 评论帖子
     */
    public function commentAdd()
    {

        $this->checkToken();
        $param = $this->param();
        //提交数据验证 -> 暂缺


        $comment = new \app\api\service\ForumPostComment;;
        //用户ID
        $param['user_id'] = $this->tokenData['id'];
        if($result = $comment->addComment($param)){

            //累加评论数
            $commentNum = (new \app\api\service\ForumPostAttr)->saveNum($param, 'comment');
            //给帖子用户发送消息
            $forum = (new \app\api\service\ForumPost)->getField($param['id'], 'user_id,title',1);
            //广播
            (new \app\api\service\SystemBroadcast)->trigger(
                1,
                'comment_num',
                ['name'=>$this->tokenData['name'],
                    'id'=>$param['id'],
                    'title'=>$forum['title'],
                    'num'=>$commentNum]);

            //规则触发
            $this->ruleTrigger('comment_num', ['id'=>$param['id'], 'num'=>$commentNum]);

            //更新评论用户的评论数
            (new \app\api\service\UserAttr)->saveNum(['id'=>$param['user_id']], 'comment');

            $toData = [
                'o_id' => $param['id'], //帖子ID　
                'o_user_id' => $param['user_id'],
                'content' => str_replace("\n","<br/>",$param['content']),
            ];
            (new \app\api\service\SystemMessage)->toUser($forum['user_id'], $toData, 1);

            //返回评论内容
            $where = [
                ['ForumPostComment.post_id', '=', $result['post_id']],
                ['ForumPostComment.id', '=', $result['id']]
            ];
            $data = $this->getCommonCommentList($comment, $where);

            return showResult(0, '评论成功', $data['list']);
        }

        return showResult(-1, '评论失败');
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

    /**
     * 规则触发器
     * @param $event 事件
     * @param $dara ['id','num']
     */
    protected function ruleTrigger($event, $dara){
        (new \app\api\service\ForumPostRule)->trigger($event, $dara);
    }
}