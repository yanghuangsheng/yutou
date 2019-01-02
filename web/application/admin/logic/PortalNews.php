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

        return [];
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
            $service = new oService;
            $data = $service->initLimit($param['page'], $param['limit'])->getListData();

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

            if((new oService)->save($postData, 1)){
                $this->resultJson(0, '更新成功');
            }else{
                $this->resultJson(-1, '更新失败');
            }
        }
    }
}