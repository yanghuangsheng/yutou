<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/31
 * Time: 17:28
 */

namespace app\api\service;


class UserCollection extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\UserCollection;
        $this->order = ['id', 'desc'];
    }


    public function checkPost(){

    }

    /**
     * 收藏资讯View
     * @return $this
     */
    public function newsView()
    {
        $this->view = $this->model->view('UserCollection', 'id,user_id,create_time')
            ->view('PortalNews', ['id'=>'news_id','title','description','image_url'], 'PortalNews.id = UserCollection.o_id')
            ->view('PortalNewsAttr', 'browse_num,praise_num,collect_num,comment_num', 'PortalNewsAttr.news_id = PortalNews.id', 'LEFT');

        return $this;
    }

    /**
     * 收藏帖子View
     * @return $this
     */
    public function postView()
    {
        $this->view = $this->model->view('UserCollection', 'id,user_id,create_time')
            ->view('ForumPost', ['id'=>'post_id','title','image_url'], 'ForumPost.id = UserCollection.o_id')
            ->view('ForumPostContent', 'content', 'ForumPostContent.post_id = ForumPost.id')
            ->view('ForumPostAttr', 'browse_num,praise_num,collect_num,comment_num', 'ForumPostAttr.post_id = ForumPost.id', 'LEFT')
            ->view('User', ['id'=>'post_user_id','name'=>'user_name','avatar'=>'user_avatar'], 'User.id = ForumPost.user_id');

        return $this;
    }

    /**
     * 处理输出数据
     * @param $data
     */
    protected function resetListData($data)
    {
        foreach ($data as $key => &$value)
        {
            if(isset($value['user_avatar'])){
                $value['user_avatar'] = $value['user_avatar']?json_decode($value['user_avatar'],1):userAvatar();
            }
        }

        return $data;
    }

    /**
     * 收藏
     * @param $data
     * @return bool
     */
    public function addCollect($data){
        $count = $this->model
            ->where('o_id', $data['id'])
            ->where('user_id', $data['user_id'])
            ->where('type', $data['type'])  // 0新闻 1贴子
            ->count();
        if($count){
            $this->error = '已收藏过了！';
            return false;
        }

        $updateData = [
            'o_id' => $data['id'],
            'user_id' => $data['user_id'],
            'type' => $data['type'],

        ];
        return $this->save($updateData);

    }

    /**
     * 删除收藏
     * @param $data
     * @return bool
     */
    public function checkDel($data)
    {
        $userId = $this->getField($data['id'], 'user_id');
        if(!($userId == $data['user_id'])){
            $this->error = '非法删除';
            return false;
        }
        if($this->delete($data['id'])){
            return true;
        }
        $this->error = '删除失败';
        return false;
    }


















}