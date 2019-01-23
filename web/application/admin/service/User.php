<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/22
 * Time: 18:03
 */

namespace app\admin\service;


class User extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\User;
        $this->order = ['id', 'desc'];
    }

    /**
     * 列表View
     * @return $this
     */
    protected function setWithOnView()
    {
        return $this->model->view('User', 'id,name,phone,status,code,last_login_time,create_time')
            ->view('UserCapital', 'golds', 'UserCapital.user_id = User.id', 'LEFT');
    }

    /**
     * 处理输出数据
     * @param $data
     */
    protected function resetListData($data)
    {
        foreach ($data as $key => &$value){
            $value['status_txt'] = $value['status']?'<span class="layui-badge layui-bg-gray">禁用</span>':'<span class="layui-badge layui-bg-green">正常</span>';
        }

        return $data;
    }
}