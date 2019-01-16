<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/16
 * Time: 17:00
 */

namespace app\www\service;


class AdImages extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\AdImages;
    }

    /**
     * 获取轮播广告
     */
    public function getCarousel($id)
    {
        $time = time();
        $this->view = $this->model->where('ad_id', $id)
            ->where('type',1) //PC平台
            ->where('put_open_time','<=',$time)
            ->where('put_end_time','>=',$time)
            ->field('link_url,image_url');

        return $this->getListData();
    }

    /**
     * 获取广告
     */
    public function getBanner($id)
    {
        $time = time();
        $this->view = $this->model->where('ad_id', $id)
            ->where('type',1) //PC平台
            ->where('put_open_time','<=',$time)
            ->where('put_end_time','>=',$time)
            ->field('link_url,image_url');
        $data = $this->getListData();

        if($data['count'] == 0){
            $data = [];
        }
        elseif($data['count'] == 1){
            $data = $data['list'][0];
        }
        else{
            $num = mt_rand(0, $data['count']-1);
            $data = $data['list'][$num];
        }
        return $data;
    }


}