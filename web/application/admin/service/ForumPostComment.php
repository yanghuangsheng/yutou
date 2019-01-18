<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/10
 * Time: 14:20
 */

namespace app\admin\service;


class ForumPostComment extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\ForumPostComment;
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
        return $this->model->with(['user', 'forumPost'])->order('id', 'desc');
    }

    /**
     * 处理输出数据
     * @param $data
     */
    protected function resetListData($data)
    {
        foreach ($data as $key => &$value){
            $value['status_txt'] = $value['status']?'<span class="layui-badge layui-bg-green">已审核</span>':'<span class="layui-badge layui-bg-gray">未审核</span>';
        }

        return $data;
    }
}