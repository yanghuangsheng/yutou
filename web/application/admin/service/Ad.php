<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/15
 * Time: 10:36
 */

namespace app\admin\service;


class Ad extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\Ad;
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
     * 数据输出处理
     * @param $data
     * @return mixed
     */
    protected function resetListData($data)
    {
        foreach ($data as $key => &$value){
            $value['num'] = (new \app\common\model\AdImages)->where('ad_id', $value['id'])->count();
        }
        return $data;
    }
}