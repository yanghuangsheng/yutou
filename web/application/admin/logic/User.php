<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/23
 * Time: 11:27
 */

namespace app\admin\logic;

use \app\admin\service\User as oService;

class User extends Base
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
     * 获取编辑页面相关
     * @return mixed
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
     * 获取数据列表
     */
    protected function getListJson()
    {
        if($this->isAjax()){
            $param = $this->param();
            $order = false;
            $where = [];
            $param['status'] == '' || $where[] = ['status', '=', $param['status']];
            if($param['phone']){
                if(is_numeric($param['phone'])){
                    $where[] = ['phone', '=', $param['phone']];
                }
                else{
                    $where[] = ['name', '=', $param['phone']];
                }
            }

            $service = new oService;
            $data = $service->initWhere($where)->initOrder($order)->initLimit($param['page'], $param['limit'])->getListData();
            $this->resultJson(0, '获取成功', $data);
        }
    }

    /**
     * 新增
     */
    public function saveAdd()
    {
        if($this->isAjax()){
            $postData = $this->post();
            $service = new oService;
            if($service->checkCount($postData['phone'])){
                $this->resultJson(-1, '手机号不可用');
            }
            if($postData['avatar']['200'] == ''){
                $postData['avatar'] = '';
            }
            if($postData['name'] == ''){
                $postData['name'] = 'yutou_' . random_string('4') . ($service->newsId()+1);
            }

            if($service->save($postData)){
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
            if($postData['avatar']['200'] == ''){
                $postData['avatar'] = '';
            }
            $oService = new oService;
            if($oService->save($postData, 1)){
                $this->resultJson(0, '更新成功');
            }else{
                $this->resultJson(-1, '更新失败');
            }
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