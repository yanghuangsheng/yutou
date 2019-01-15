<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/15
 * Time: 10:35
 */

namespace app\admin\service;


class AdImages extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\AdImages;
        $this->order = ['id', 'desc'];
        $this->keyId = 'AdImages.id';
    }

    /**
     * 设置可更新字段
     * @return array
     */
    public function setAllowField()
    {
        return true;
    }

    /**
     * 列表view
     */
    protected function setWithOnView()
    {
        return $this->model->view('AdImages', 'id,title,type,image_url,put_open_time,put_end_time')
            ->view('Ad', 'name,size', 'Ad.id = AdImages.ad_id');
    }

    /**
     * 单条view
     */
    protected function setOneWithOnView()
    {
        return $this->model->view('AdImages', 'id,title,type,image_url,link_url,description,put_open_time,put_end_time')
            ->view('Ad', ['name','size'], 'Ad.id = AdImages.ad_id');
    }
}