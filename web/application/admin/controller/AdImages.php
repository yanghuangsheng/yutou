<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/15
 * Time: 10:27
 */

namespace app\admin\controller;

use app\admin\logic\AdImages as AdImagesLogic;

class AdImages extends Base
{
    /**
     * 列表
     * @param AdImagesLogic $logic
     * @return mixed
     */
    public function index(AdImagesLogic $logic)
    {
        $data = (new $logic)->getList();

        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 增加广告位
     * @param AdImagesLogic $logic
     * @return mixed
     */
    public function addAd(AdImagesLogic $logic)
    {
        $data = $logic->getAddAd();
        return $this->fetch();
    }

    /**
     * 新增
     * @param AdImagesLogic $logic
     * @return mixed
     */
    public function add(AdImagesLogic $logic)
    {
        $data = $logic->getAdd();
        //print_r($data);
        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 上传广告图
     * @return mixed
     */
    public function uploadFile()
    {
        $upload = (new \app\admin\logic\Upload);
        $data = $upload->upFile('ad_images');
        if(isset($data['error'])){
            $upload->resultJson(-1,$data['error']);
        }

        $upload->resultJson(0,'success',$data);
    }

    /**
     * 编辑
     * @param AdImagesLogic $logic
     * @return mixed
     */
    public function edit(AdImagesLogic $logic)
    {
        $data = $logic->getEdit();

        $this->assign('data', $data);
        return $this->fetch();
    }

    /**
     * 删除
     * @param AdImagesLogic $logic
     * @return mixed
     */
    public function delete(AdImagesLogic $logic)
    {
        return (new $logic)->delete();
    }
}