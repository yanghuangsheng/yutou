<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/10
 * Time: 10:51
 */

namespace app\admin\logic;

use app\admin\service\PortalNewsComment as oService;

class PortalNewsComment extends Base
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
     * 删除
     */
    public function delete()
    {
        if($this->isAjax()){
            $del_id = $this->param('id');

            if((new oService)->delete($del_id)){
                $this->resultJson(0, '删除成功');
            }

            $this->resultJson(-1, '删除失败');

        }
    }

    /**
     * 审核
     */
    public function updateFieldByValue()
    {
        if($this->isAjax()){
            $data = $this->param('id');

            if((new oService)->updateFieldByValue($data)){
                $this->resultJson(0, '更新成功');
            }

            $this->resultJson(-1, '更新失败');
        }
    }

    /**
     * 获取数据列表
     */
    protected function getListJson()
    {
        if($this->isAjax()){
            $param = $this->param();
            $service = new oService;
            $data = $service->initLimit($param['page'], $param['limit'])->getListData();
            $this->resultJson(0, '获取成功', $data);
        }
    }
}