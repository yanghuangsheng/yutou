<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/5
 * Time: 14:24
 */

namespace app\admin\logic;

use app\admin\service\PortalNewsCategory as oService;
use app\admin\service\TreeList;

class PortalNewsCategory extends Base
{
    /**
     * 获取列表
     * @return string
     */
    public function getList()
    {
        $data = (new oService)->getListData();

        return (new TreeList)->toList($data['list']->toArray());
    }

    /**
     * 获取新增页面相关
     * @return mixed
     */
    public function getAdd()
    {
        $this->saveAdd();

        $parent_id = $this->param('parent_id');
        $parent = (new oService)->getListData();

        $data = [
            'parent_list' => (new TreeList)->toItems($parent['list']->toArray(), $parent_id),
        ];

        return $data;
    }

    /**
     * 获取编辑页面相关
     * @return mixed
     */
    public function getEdit()
    {
        $this->saveEdit();

        $edit_id = $this->param('id');
        $parent = (new oService)->getListData();

        $data = (new oService)->getOneData($edit_id);
        $data['parent_list'] = (new TreeList)->toItems($parent['list']->toArray(), $data['parent_id']);
        //print_r($data);
        return $data;
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
     * 更新排序
     * @return bool
     */
    public function saveListOrders()
    {
        $params = $this->param();
        $list_orders = isset($params['list_orders']) ? $params['list_orders'] : [];
        $data = [];
        foreach ($list_orders as $k => $vo) {
            $data[] = [
                'id' => $k,
                'list_order' => $vo
            ];
        }

        if(count($data) == 0){
            $this->resultJson(0, '排序成功');
        }

        if((new oService)->listOrder($data)){
            $this->resultJson(0, '排序成功');
        }else{
            $this->resultJson(-1, '排序失败');
        }

    }

    /**
     * 新增
     */
    protected function saveAdd()
    {
        if($this->isAjax()){
            $postData = $this->post();
            if((new oService)->save($postData)){
                $this->resultJson(0, '新增成功');
            }else{
                $this->resultJson(-1, '新增失败');
            }
        }
    }

    /**
     * 更新
     */
    protected function saveEdit()
    {
        if($this->isAjax()){
            $postData = $this->post();
            if((new oService)->save($postData, 1)){
                $this->resultJson(0, '更新成功');
            }else{
                $this->resultJson(-1, '更新失败');
            }
        }
    }
}