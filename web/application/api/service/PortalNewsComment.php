<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/26
 * Time: 16:37
 */

namespace app\api\service;


class PortalNewsComment extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\PortalNewsComment;
        $this->order =  ['id', 'desc'];
    }


    /**
     * 关联模形
     * @return $this
     */
    protected function setWithOnView()
    {
        return $this->model->view('PortalNewsComment', 'id,parent_id,user_id,news_id,content,create_time as date_time')
            ->view('User', ['name'=>'user_name', 'avatar'=>'user_avatar'], 'User.id = PortalNewsComment.user_id', 'LEFT')
            ->view('User reply', ['name'=>'reply_name', 'avatar'=>'reply_avatar'], 'reply.id = PortalNewsComment.reply_user_id', 'LEFT')
            ->view('PortalNewsComment replyComment', ['content'=>'reply_content'], 'replyComment.id = PortalNewsComment.reply_id', 'LEFT')
            ->view('PortalNewsCommentAttr', ['praise_num','tread_num'], 'PortalNewsCommentAttr.comment_id = PortalNewsComment.id', 'LEFT');
    }

    /**
     * 新增评论记录
     * @param $data
     * @return bool
     */
    public function addComment($data)
    {
        $updateData = [
            'news_id' => $data['id'],
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
            'news_id' => $data['id'],
            'parent_id' => $data['parent'],
            'user_id' => $data['user_id'],
            'reply_id' => $data['reply_id'],
            'content' => $data['content'],
        ];
        return $this->save($updateData);
    }

    /**
     * 处理输出数据
     * @param $data
     */
    protected function resetListData($data)
    {
        foreach ($data as $key => &$value){
            $value['user_avatar'] = $value['user_avatar'] ? json_decode($value['user_avatar'],1) :userAvatar();
            $value['reply_avatar'] = $value['reply_avatar'] ? json_decode($value['reply_avatar'],1) :userAvatar();
            $value['date_time'] = getWeek($value['date_time']);

        }

        return $data;
    }
}






















