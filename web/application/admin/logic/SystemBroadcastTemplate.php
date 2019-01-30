<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/25
 * Time: 16:16
 */

namespace app\admin\logic;

use app\admin\service\SystemBroadcastTemplate as oService;

class SystemBroadcastTemplate extends Base
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
     * 新增页面
     */
    public function getAdd()
    {
        $this->saveAdd();
    }

    /**
     * 编辑页面
     */
    public function getEdit()
    {
        $this->saveEdit();
        $edit_id = $this->param('id');
        $data = (new oService)->getOneData($edit_id);

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
     * 处理新增
     */
    protected function saveAdd()
    {
        if($this->isAjax()){
            $paramData = $this->param();
            $service = (new oService);
            if($obj = $service->save($paramData, 0)){

                $this->resultJson(0, '新增成功');
            }else{
                $this->resultJson(-1, '新增失败');
            }
        }
    }

    /**
     * 处理编辑
     */
    protected function saveEdit()
    {
        if($this->isAjax()){
            $paramData = $this->param();
            $service = (new oService);
            if($obj = $service->save($paramData, 1)){
                $this->resultJson(0, '更新成功');
            }else{
                $this->resultJson(-1, '更新失败');
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
            $param['trigger_type'] == '' || $where[] = ['trigger_type', '=', $param['trigger_type']];


            $service = new oService;
            $data = $service->initWhere($where)->initOrder($order)->initLimit($param['page'], $param['limit'])->getListData();
            $this->resultJson(0, '获取成功', $data);
        }
    }
}