<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/29
 * Time: 15:56
 */

namespace app\www\service;


class ForumPostComment extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\ForumPostComment;
        $this->order =  ['id', 'desc'];
    }


    /**
     * 关联模形
     * @return $this
     */
    protected function setWithOnView()
    {
        return $this->model->view('ForumPostComment', 'id,parent_id,user_id,post_id,reply_id,content,create_time as date_time')
            ->view('User', ['name'=>'user_name', 'avatar'=>'user_avatar'], 'User.id = ForumPostComment.user_id', 'LEFT')
            ->view('User reply', ['name'=>'reply_name', 'avatar'=>'reply_avatar'], 'reply.id = ForumPostComment.reply_id', 'LEFT')
            ->view('ForumPostCommentAttr', ['praise_num','tread_num'], 'ForumPostCommentAttr.comment_id = ForumPostComment.id', 'LEFT');
    }

    /**
     * 消息获取单条View
     * @param $id
     * @return mixed
     */
    public function messageOne($id)
    {
        return $this->model->view('ForumPostComment', 'post_id,content')
            ->view('ForumPostCommentAttr', ['praise_num','tread_num'], 'ForumPostCommentAttr.comment_id = ForumPostComment.id', 'LEFT')
            ->where('id', $id)->find();
    }

    /**
     * 新增评论记录
     * @param $data
     * @return bool
     */
    public function addComment($data)
    {
        $updateData = [
            'post_id' => $data['id'],
            'user_id' => $data['user_id'],
            'content' => str_replace("\n","<br/>",$data['content']),
        ];

        return $this->save($updateData);
    }

    /**
     * 新增评论回复
     * @param $data
     * @return bool
     */
    public function addReplyComment($data)
    {
        $updateData = [
            'post_id' => $data['id'],
            'parent_id' => $data['parent'],
            'user_id' => $data['user_id'],
            'reply_id' => $data['reply_id'],
            'content' => $data['content'],
        ];
        return $this->save($updateData);
    }
}