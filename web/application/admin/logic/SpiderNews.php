<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/30
 * Time: 15:29
 */

namespace app\admin\logic;

use app\admin\service\SpiderNews as oService;

class SpiderNews extends Base
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
     * 转发
     */
    public function toRelay()
    {
        if($this->isAjax()){
            $relay_id = $this->param('id');
            $service = new oService;
            $data = $service->collectionContent($relay_id);
            if(isset($data['error'])){
                $this->resultJson(-1, $data['error']);

            }else{
                if((new \app\admin\service\PortalNews)->toRelayAdd($data)){
                    //更新转发状态
                    $service->updateFieldByValue(['id'=>$relay_id, 'field'=>'status', 'value'=>1]);
                    $this->resultJson(0, '转发成功');
                }
                $this->resultJson(-1, '转发失败');
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
            $service = new oService;
            $data = $service->initLimit($param['page'], $param['limit'])->getListData();
            $this->resultJson(0, '获取成功', $data);
        }
    }

}