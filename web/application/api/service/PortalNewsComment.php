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
        $this->order =  ['PortalNewsComment.id', 'desc'];
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
     * 用户评论
     * @return $this
     */
    public function userCommentView()
    {
        $this->view = $this->model->view('PortalNewsComment', 'content,create_time as date_time')
            ->view('User', 'name,avatar as user_avatar', 'User.id = PortalNewsComment.user_id','LEFT')
            ->view('PortalNews', 'title,image_url,description', 'PortalNews.id = PortalNewsComment.news_id', 'LEFT')
            ->view('PortalNewsAttr', 'browse_num,praise_num,collect_num,comment_num', 'PortalNewsAttr.news_id = PortalNewsComment.news_id', 'LEFT');

        return $this;
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

        //回复相关
        isset($data['parent_id']) && $updateData['parent_id'] = $data['parent_id'];
        isset($data['reply_id']) && $updateData['reply_id'] = $data['reply_id'];
        isset($data['reply_user_id']) && $updateData['reply_user_id'] = $data['reply_user_id'];


        return $this->save($updateData, 0, 1);
    }


    /**
     * 处理输出数据
     * @param $data
     */
    protected function resetListData($data)
    {
        foreach ($data as $key => &$value){
            if(isset($value['reply_avatar'])){
                $value['reply_avatar'] = $value['reply_avatar'] ? json_decode($value['reply_avatar'],1) :userAvatar();
            }
            $value['user_avatar'] = $value['user_avatar'] ? json_decode($value['user_avatar'],1) :userAvatar();
            $value['date_time'] = friendlyDate($value['date_time']);

        }

        return $data;
    }
}






















