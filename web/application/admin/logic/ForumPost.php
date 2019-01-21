<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/10
 * Time: 13:53
 */

namespace app\admin\logic;

use \app\admin\service\ForumPost as oService;

class ForumPost extends Base
{
    /**
     * 获取列表
     * @return string
     */
    public function getList()
    {
        $this->getListJson();

        return [];
    }

    /**
     * 删除分类
     */
    public function delete()
    {
        if($this->isAjax()){
            $del_id = $this->param('id');

            if((new oService)->delete($del_id)){
                $this->resultJson(0, '删除成功');
            }else{
                $this->resultJson(-1, '删除失败');
            }
        }
    }

    /**
     * 获取数据列表
     */
    protected function getListJson()
    {
        if($this->isAjax()){
            $param = $this->param();
            $order = false;
            $where = [];
            $param['status'] == '' || $where[] = ['status', '=', $param['status']];
            $param['type'] == 'hot' && $where[] = ['hot', '=', 1];
            $param['type'] == 'topic' && $where[] = ['topic', '=', 1];
            $param['title'] == '' || $where[] = ['title', 'like', '%'.$param['title'].'%'];

            if($param['open_time'] && $param['end_time']){
                $where[] = ['ForumPost.create_time', ['<=', strtotime($param['end_time'])], ['>=', strtotime($param['open_time'])], 'and'];
            }else{
                $param['open_time'] && $where[] = ['ForumPost.create_time', '>=', strtotime($param['open_time'])];
                $param['end_time'] &&  $where[] = ['ForumPost.create_time', '<=', strtotime($param['end_time'])];
            }

            $param['order'] == 'browse_num' && $order = ['browse_num', 'desc'];
            $param['order'] == 'praise_num' && $order = ['praise_num', 'desc'];
            $param['order'] == 'collect_num' && $order = ['collect_num', 'desc'];
            $param['order'] == 'comment_num' && $order = ['comment_num', 'desc'];

            $service = new oService;
            $data = $service->initWhere($where)->initOrder($order)->initLimit($param['page'], $param['limit'])->getListData();
            $this->resultJson(0, '获取成功', $data);
        }
    }

    /**
     * 更新某个字段
     */
    public function updateFieldByValue()
    {
        if($this->isAjax()){
            $data = $this->param();

            if((new oService)->updateFieldByValue($data)){
                $this->resultJson(0, '更新成功');
            }

            $this->resultJson(-1, '更新失败');
        }
    }
}