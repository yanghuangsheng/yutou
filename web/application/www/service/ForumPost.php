<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/29
 * Time: 14:36
 */

namespace app\www\service;


class ForumPost extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\ForumPost;
        $this->order = ['id', 'desc'];
        $this->keyId = 'ForumPost.id';
    }

    /**
     * 设置可更新字段
     * @return array
     */
    public function setAllowField()
    {
        return true;
    }

    /**
     * 额外新增
     * @param $data
     */
    protected function setSaveAdd($data)
    {
        $content = new \app\common\model\ForumPostContent;
        $content->post_id = $data['id'];
        $content->content = $data['content'];
        $content->save();
    }

    /**
     * 查询列表View
     * @return $this
     */
    protected function setWithOnView()
    {
        return $this->model->view('ForumPost', 'id,user_id,title,image_url,create_time')
            ->view('ForumPostContent', 'content', 'ForumPostContent.post_id = ForumPost.id')
            ->view('User', ['name'=>'user_name', 'avatar'=>'user_avatar'], 'User.id = ForumPost.user_id')
            ->view('ForumPostAttr', 'browse_num,praise_num,collect_num,comment_num', 'ForumPostAttr.post_id = ForumPost.id', 'LEFT');
    }

    /**
     * 查询单条View
     * @return $this
     */
    protected function setOneWithOnView()
    {
        return $this->model->view('ForumPost', 'id,user_id,title,image_url,create_time')
            ->view('ForumPostContent', 'content', 'ForumPostContent.post_id = ForumPost.id')
            ->view('User', ['name'=>'user_name', 'avatar'=>'user_avatar'], 'User.id = ForumPost.user_id')
            ->view('UserAttr',['praise_num'=>'user_praise'], 'UserAttr.user_id = ForumPost.user_id', 'LEFT')
            ->view('ForumPostAttr', 'browse_num,praise_num,collect_num,comment_num', 'ForumPostAttr.post_id = ForumPost.id', 'LEFT');
    }





    /**
     * 上一条 下一条
     * @param $id
     * @return mixed
     */
    public function relatedData($id)
    {
        return [
            'prev' => $this->oneView()->where('status', 1)->where('id', '<', $id)->order('id', 'desc')->find(),
            'next' => $this->oneView()->where('status', 1)->where('id', '>', $id)->order('id', 'asc')->find(),
        ];

    }

    /**
     * 最近7天热门资讯
     * @param int $num
     */
    public function hotData($num = 7)
    {
        $newTime = $this->newsId('create_time');
        //发布时间最新的时间 7天前的时间
        $endTime = $newTime - $num * 24 * 360;

        return $this->oneView()->where('ForumPost.create_time', '<=', $newTime)
            ->where('ForumPost.create_time', '>=', $endTime)
            ->where('ForumPost.status', 1)
            ->order('ForumPost.id', 'desc')
            ->limit(15)->select();
    }

    /**
     * 查询上一条下一条View
     * @return $this
     */
    protected function oneView()
    {
        return $this->model->view('ForumPost', 'id,title,image_url,create_time')
            ->view('ForumPostAttr', 'browse_num,praise_num,collect_num,comment_num', 'ForumPostAttr.post_id = ForumPost.id', 'LEFT');
    }
}