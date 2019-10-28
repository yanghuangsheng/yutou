<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/25
 * Time: 15:06
 */

namespace app\admin\service;


class SystemMessageTask extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\SystemMessageTask;
        $this->order = ['id', 'desc'];
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
     * 处理返回数据
     * @param $data
     */
    protected function resetListData($data)
    {
        foreach ($data as $key => &$value){
            $value['type_txt'] = $value['type']?'私人消息':'全体消息';
            $value['user_txt'] = $value['user_id']?$value['user_id']:'全体用户';
            $value['send_txt'] = $value['send']?'<span class="layui-badge layui-bg-green">是</span>':'<span class="layui-badge layui-bg-gray">否</span>';
            $value['status_txt'] = $value['status']?'<span class="layui-badge layui-bg-green">已推送</span>':'<span class="layui-badge layui-bg-gray">未推送</span>';
        }

        return $data;
    }
}