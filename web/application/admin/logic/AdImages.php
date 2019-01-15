<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/15
 * Time: 10:30
 */

namespace app\admin\logic;

use \app\admin\service\AdImages as oService;

class AdImages extends Base
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
            }else{
                $this->resultJson(-1, '删除失败');
            }
        }
    }

    /**
     * 增加广告位
     */
    public function getAddAd()
    {
        $this->saveAddAd();
        return [];
    }

    /**
     * 获取新增页面相关
     * @return mixed
     */
    public function getAdd()
    {
        $this->saveAdd();
        $adList = (new \app\admin\service\Ad)->getListData();

        $data = [
            'ad_list' => $adList,
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
        $adList = (new \app\admin\service\Ad)->getListData();


        $data = (new oService)->getOneData($edit_id);

        $data['ad_list'] = $adList;
        return $data;
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
     * 新增广告位
     */
    protected function saveAddAd()
    {
        if($this->isAjax()){
            $postData = $this->param();
            if((new \app\admin\service\Ad)->save($postData)){
                $this->resultJson(0, '新增成功');
            }else{
                $this->resultJson(-1, '新增失败');
            }
        }
    }

    /**
     * 新增
     */
    protected function saveAdd()
    {
        if($this->isAjax()){
            $postData = $this->param();
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
            $postData = $this->param();
            //不存在 补充

            if((new oService)->save($postData, 1)){
                $this->resultJson(0, '更新成功');
            }else{
                $this->resultJson(-1, '更新失败');
            }
        }
    }
}