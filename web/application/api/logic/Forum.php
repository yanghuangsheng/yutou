<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/22
 * Time: 16:30
 */

namespace app\api\logic;

use \app\www\service\ForumPost;

class Forum extends Base
{
    /**
     * 获取列表
     * @param string $type new最新 hot热门
     * @return mixed
     */
    public function getList($type = 'new')
    {
        $param = $this->param();
        isset($param['page']) || $param['page'] = 1;

        $service = new ForumPost;
        $where[] = ['ForumPost.status', '=', 1];
        if($type == 'hot'){
            $where[] = ['ForumPost.hot', '=', 1];
        }

        isset($param['start_id']) && $where[] = ['ForumPost.id', '<=', $param['start_id']];

        $data = $service->initWhere($where)->initLimit($param['page'])->getListData();

        $data['list'] = $data['list']->toArray();
        foreach ($data['list'] as $key => &$value){
            $value['description'] = clean_html($value['content'], 60);
            foreach ($value['user_avatar'] as $key1 => &$value1){
                $value1 = $this->getDomain().$value1;
            }
            foreach ($value['image_url'] as $key1 => &$value1){
                $value1 = $this->getDomain().$value1;
            }

        }
        $data['type'] = $type;

        return $data;
    }

    /**
     * 加载更多帖子列表
     */
    public function gitLoadList()
    {
        $type = $this->param('type');
        $data = $this->getList($type);

        return $data;

    }

    /**
     * 获取最新的ID
     * @return mixed
     */
    public function getNewsId()
    {
        $service = new ForumPost;

        return $service->newsId();
    }
}