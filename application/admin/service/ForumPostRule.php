<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/8
 * Time: 18:13
 */

namespace app\admin\service;


class ForumPostRule extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\ForumPostRule;
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
     * 处理返回数据
     * @param $data
     */
    protected function resetListData($data)
    {
        $field = [
            'browse_num' => '浏览数',
            'praise_num' => '点赞数',
            'collect_num' => '收藏数',
            'comment_num' => '评论数',
        ];
        $type = [
            'hot' => '热门',
            'topic' => '话题',
        ];
        foreach ($data as $key => &$value){
            $value['trigger_field_txt'] = $field[$value['trigger_field']];
            $value['trigger_type_txt'] = $type[$value['trigger_type']];
        }

        return $data;
    }

}