<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/24
 * Time: 14:51
 */

namespace app\api\service;


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
     * @return \app\common\model\UserCapitalLog
     */
    protected function setWithOnView()
    {
        return $this->model->view('UserCapitalLog', 'id,user_id,pay,residue,explain,create_time')
            ->view('User', 'name', 'User.id = UserCapitalLog.user_id', 'LEFT');
    }

    /**
     * 记录单条日志
     * @param $data
     * @param int $o_type
     * @return bool
     */
    public function giveGoldsLog($data, $o_type = 0)
    {
        $operation = substr($data['pay'], 0, 1);
        is_numeric($operation) && $data['pay'] = '+'.$data['pay'];
        $data['o_type'] = $o_type;
        if($this->save($data)){
            return true;
        }
        return false;
    }

    /**记录多条金币交易日志
     * @param $data
     * @return int|string
     */
    public function allGoldsLog($data)
    {
        return $this->model->data($data)->limit(100)->insertAll();
    }

    /**
     * 记录鱼鳞单条日志
     * @param $data
     * @param int $o_type
     * @return bool
     */
    public function giveScaleLog($data, $o_type = 0)
    {
        $operation = substr($data['pay'], 0, 1);
        is_numeric($operation) && $data['pay'] = '+'.$data['pay'];
        $data['type'] = 1;
        $data['o_type'] = $o_type;
        if($this->save($data)){
            return true;
        }
        return false;
    }

    /**记录多条鱼鳞交易日志
     * @param $data
     * @return int|string
     */
    public function allScaleLog($data)
    {
        foreach ($data as $key => &$value){
            $value['type'] = 1;
        }
        return $this->model->data($data)->limit(100)->insertAll();
    }



}