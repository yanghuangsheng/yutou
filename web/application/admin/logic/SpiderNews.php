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
        $categoryList = (new \app\admin\service\SpiderNewsCategory)->getListData();
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
                $portalNews = new \app\admin\service\PortalNews;
//                $newsId = $portalNews->getOneField([['source_url', '=', $data['source_url']]], 'id');
//                if($newsId){
//                    $portalNews->save(['id'=>$newsId,'content'=>$data['content'], 'image_url'=>$data['image_url']],1);
//                    $this->resultJson(0, '更新成功');
//                }
                if($portalNews->toRelayAdd($data)){
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
            $where = [];

            $param['category_id'] == '' || $where[] = ['category_id', '=', $param['category_id']];
            $param['status'] == '' || $where[] = ['status', '=', $param['status']];
            $param['title'] == '' || $where[] = ['title', 'like', '%'.trim($param['title']).'%'];
            $service = new oService;

            $data = $service->initWhere($where)->initLimit($param['page'], $param['limit'])->getListData();
            $this->resultJson(0, '获取成功', $data);
        }
    }

}