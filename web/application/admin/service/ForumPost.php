<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/10
 * Time: 13:59
 */

namespace app\admin\service;


class ForumPost extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\ForumPost;
        $this->order = ['id', 'desc'];
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
     * 关联模形
     * @return $this
     */
    protected function setWithOnView()
    {
        return $this->model->view('ForumPost', 'id,title,status,hot,topic,create_time')
            ->view('ForumPostAttr', 'browse_num,praise_num,collect_num,comment_num', 'ForumPostAttr.post_id = ForumPost.id', 'LEFT')
            ->view('User', ['name'=>'user_name'], 'User.id = ForumPost.user_id');
    }

    /**
     * 额外删除
     * @param $id
     */
    protected function setDelete($id)
    {
        $oTime = time();
        (new \app\common\model\ForumPostContent)->where('post_id', 'IN', $id)->data(['delete_time' => $oTime])->update();
        (new \app\common\model\SystemBroadcast)->where('o_id', 'IN', $id)->where('type', '=', 0)->data(['delete_time' => $oTime])->update();
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
     * 额外修改
     * @param $data
     */
    protected function setSaveUpdate($data)
    {
        $content = new \app\common\model\ForumPostContent;
        $content->save(['content' => $data['content']], ['post_id' => $data['id']]);

    }

    /**
     * 处理输出数据
     * @param $data
     */
    protected function resetListData($data)
    {
        foreach ($data as $key => &$value){
            $value['status_txt'] = $value['status']?'<span class="layui-badge layui-bg-green">已发布</span>':'<span class="layui-badge layui-bg-gray">未发布</span>';
            $value['hot_txt'] = $value['hot']?'<span class="layui-badge layui-bg-green">热门帖</span>':'<span class="layui-badge layui-bg-gray">未热门</span>';
            $value['topic_txt'] = $value['topic']?'<span class="layui-badge layui-bg-green">话题帖</span>':'<span class="layui-badge layui-bg-gray">未话题</span>';
        }

        return $data;
    }
}