<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/29
 * Time: 15:56
 */

namespace app\api\service;


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
            ->view('User reply', ['name'=>'reply_name', 'avatar'=>'reply_avatar'], 'reply.id = ForumPostComment.reply_user_id', 'LEFT')
            ->view('ForumPostComment replyComment', ['content'=>'reply_content'], 'replyComment.id = ForumPostComment.reply_id', 'LEFT')
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

        //回复相关
        isset($data['parent_id']) && $updateData['parent_id'] = $data['parent_id'];
        isset($data['reply_id']) && $updateData['reply_id'] = $data['reply_id'];
        isset($data['reply_user_id']) && $updateData['reply_user_id'] = $data['reply_user_id'];

        return $this->save($updateData, 0, 1);
    }


    /**
     * 处理输出数据
     * @param $data
     * @return mixed
     */
    protected function resetListData($data)
    {
        foreach ($data as $key => &$value){
            $value['user_avatar'] = $value['user_avatar'] ? json_decode($value['user_avatar'],1) :userAvatar();
            $value['reply_avatar'] = $value['reply_avatar'] ? json_decode($value['reply_avatar'],1) :userAvatar();

        }
        return $data;
    }

    /**
     * 处理单条输出数据
     * @param $data
     * @return mixed
     */
    protected function resetFindData($data)
    {
        $data['user_avatar'] = $data['user_avatar'] ? json_decode($data['user_avatar'],1) :userAvatar();

        return $data;
    }
}