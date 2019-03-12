<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/30
 * Time: 17:40
 */

namespace app\admin\logic;

use app\admin\service\SpiderLottery as oService;

class SpiderLottery extends Base
{
    /**
     * 获取列表
     * @return string
     */
    public function getList()
    {
        $this->getListJson();
        $categoryList = (new \app\admin\service\SpiderLotteryCategory)->getListData();
        $data = [
            'category_list' => (new \app\admin\service\TreeList)->toItems($categoryList['list']->toArray()),
        ];
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
            $where = [];

            $param['category_id'] == '' || $where[] = ['category_id', '=', $param['category_id']];
            $param['lottery_no'] == '' || $where[] = ['lottery_no', '=', $param['lottery_no']];
            $service = new oService;
            $data = $service->initWhere($where)->initLimit($param['page'], $param['limit'])->getListData();
            $this->resultJson(0, '获取成功', $data);
        }
    }

}