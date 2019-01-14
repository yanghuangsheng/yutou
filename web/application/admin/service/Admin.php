<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/22
 * Time: 15:40
 */

namespace app\admin\service;


class Admin extends Base
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\Admin;
    }

    /**
     * 获取用户登陆信息
     * @param $user_account
     * @return array|null|\PDOStatement|string|\think\Model
     */
    public function getInfoData($user_account)
    {
        return $this->model->where('user_account', $user_account)
            ->field('id,user_name,user_account,user_password,login_last_time')
            ->find()->toArray();
    }

    /**
     * 更新用户登陆时间
     * @param $id
     */
    public function updateLastTime($id)
    {
        $this->model->where('id',$id)->update(['login_last_time'=>time()]);
    }

}