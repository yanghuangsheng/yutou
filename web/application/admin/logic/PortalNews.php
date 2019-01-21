<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/5
 * Time: 14:54
 */

namespace app\admin\logic;

use app\admin\service\PortalNews as oService;

class PortalNews extends Base
{
    /**
     * 获取列表
     * @return string
     */
    public function getList()
    {
        $this->getListJson();
        $categoryList = (new \app\admin\service\PortalNewsCategory)->getListData();
        $data = [
            'category_list' => (new \app\admin\service\TreeList)->toItems($categoryList['list']->toArray()),
        ];

        return $data;
    }

    /**
     * 获取新增页面相关
     * @return mixed
     */
    public function getAdd()
    {
        $this->saveAdd();
        $categoryList = (new \app\admin\service\PortalNewsCategory)->getListData();

        $data = [
            'category_list' => (new \app\admin\service\TreeList)->toItems($categoryList['list']->toArray()),
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
        $categoryList = (new \app\admin\service\PortalNewsCategory)->getListData();


        $data = (new oService)->getOneData($edit_id);

        $data['category_list'] = (new \app\admin\service\TreeList)->toItems($categoryList['list']->toArray(),isset($data['category_id'])?explode(',',$data['category_id']):0);

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
            $order = false;//不改排序
            $where = [];

            $param['category_id'] == '' || $where[] = ['PortalNewsInCategory.category_id', '=', $param['category_id']];
            $param['title'] == '' || $where[] = ['title', 'like', '%' . $param['title'] . '%'];
            $param['status'] == '' || $where[] = ['PortalNews.status', '=', $param['status']];
            if($param['open_time'] && $param['end_time']){
                $where[] = ['published_time', ['<=', strtotime($param['end_time'])], ['>=', strtotime($param['open_time'])], 'and'];
            }else{
                $param['open_time'] && $where[] = ['published_time', '>=', strtotime($param['open_time'])];
                $param['end_time'] &&  $where[] = ['published_time', '<=', strtotime($param['end_time'])];
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
            //不存在 补充
            !isset($postData['status']) && $postData['status'] = 0;
            !isset($postData['hot']) && $postData['hot'] = 0;
            !isset($postData['top']) && $postData['top'] = 0;
            !isset($postData['recommended']) && $postData['recommended'] = 0;
            $oService = new oService;
            if($oService->save($postData, 1)){
                $categoryTxt = $oService->newsCategory($postData['category_id']);
                $this->resultJson(0, '更新成功',['category_name'=>$categoryTxt]);
            }else{
                $this->resultJson(-1, '更新失败');
            }
        }
    }
}