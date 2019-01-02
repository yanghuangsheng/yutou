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
        return $this->model->with(['user'])->order('id', 'desc');
    }

    /**
     * 额外删除
     * @param $id
     */
    protected function setDelete($id)
    {
        $oTime = time();
        (new \app\common\model\ForumPostContent)->where('news_id', $id)->data(['delete_time' => $oTime])->save();
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
}