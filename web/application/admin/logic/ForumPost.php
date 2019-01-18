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
            $whereMap = [];
            $param['status'] == '' || $whereMap[] = ['status', '=', $param['status']];
            $param['type'] == 'hot' && $whereMap[] = ['hot', '=', 1];
            $param['type'] == 'topic' && $whereMap[] = ['topic', '=', 1];
            $param['title'] == '' || $whereMap[] = ['title', 'like', '%'.$param['title'].'%'];

            $service = new oService;
            $data = $service->initWhere($whereMap)->initLimit($param['page'], $param['limit'])->getListData();
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