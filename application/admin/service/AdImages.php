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
        return $this->model->view('AdImages', 'id,title,type,image_url,link_url,put_open_time,put_end_time')
            ->view('Ad', 'name,size', 'Ad.id = AdImages.ad_id');
    }

    /**
     * 单条view
     */
    protected function setOneWithOnView()
    {
        return $this->model->view('AdImages', 'id,ad_id,title,type,image_url,link_url,description,put_open_time,put_end_time')
            ->view('Ad', ['name','size'], 'Ad.id = AdImages.ad_id');
    }

    /**
     * 数据输出处理
     * @param $data
     * @return mixed
     */
    protected function resetListData($data)
    {
        foreach ($data as $key => &$value){
            $value['type_txt'] = adType($value['type']);
            $value['image_url'] = '<img src="'.$value['image_url'].'" height="28px">';
            $value['status_txt'] = ($value['put_end_time'] < date('Y-m-d H:i:s'))?'<span class="layui-badge layui-bg-gray">已下架</span>':'<span class="layui-badge layui-bg-green">上架中</span>';
        }
        return $data;
    }

    /**
     * 数据处理输出
     * @param $data
     */
    protected function resetFindData($data)
    {
        $data['size'] = json_decode($data['size'],1);
        $data['num'] = $this->model->where('ad_id', $data['ad_id'])->count();

        return $data;
    }

}