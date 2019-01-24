<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/28
 * Time: 12:07
 */

namespace app\admin\service;


class SpiderNewsRule extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\SpiderNewsRule;
    }

    /**
     * 设置可更新字段
     * @return array
     */
    public function setAllowField()
    {
        return [
            'category_id', //分类ID
            'name', //名称
            'url', //地址
            'route', //路径
            'content', //内容
            'status', //采集状态
        ];
    }

    /**
     * 列表数据处理
     * @param $data
     */
    protected function resetListData($data)
    {
        foreach ($data as $key => &$value)
        {
            $value['status_txt'] = $value['status']?'<span class="layui-badge layui-bg-green">开启</span>':'<span class="layui-badge layui-bg-gray">关闭</span>';
        }

        return $data;
    }

    /**
     * 关联模形
     * @return $this
     */
    protected function setWithOnView()
    {
        return $this->model->with(['spiderNewsCategory']);
    }

}