<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/25
 * Time: 15:10
 */

namespace app\admin\logic;

use app\admin\service\SystemMessageTask as oService;

class SystemMessageTask extends Base
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
//            $param['status'] == '' || $where[] = ['status', '=', $param['status']];
//            if($param['phone']){
//                if(is_numeric($param['phone'])){
//                    $where[] = ['phone', '=', $param['phone']];
//                }
//                else{
//                    $where[] = ['name', '=', $param['phone']];
//                }
//            }

            $service = new oService;
            $data = $service->initWhere($where)->initOrder($order)->initLimit($param['page'], $param['limit'])->getListData();
            $this->resultJson(0, '获取成功', $data);
        }
    }
}