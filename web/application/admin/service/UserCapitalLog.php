<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/24
 * Time: 14:51
 */

namespace app\admin\service;


class UserCapitalLog extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\UserCapitalLog;
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
     * 列表View
     * @return $this
     */
    protected function setWithOnView()
    {
        return $this->model->view('UserCapitalLog', 'id,user_id,pay,residue,explain,create_time')
            ->view('User', 'name', 'User.id = UserCapitalLog.user_id', 'LEFT');
    }

    /**
     * 记录日志
     * @param $data
     * @return bool
     */
    public function giveGoldsLog($data)
    {
        if($this->save($data)){
            return true;
        }
        return false;
    }



}