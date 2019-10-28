<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/28
 * Time: 12:04
 */

namespace app\api\service;


class UserAttr extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\UserAttr;
    }


    /**
     * 更新数目
     * @param $data
     * @param $field
     * @return bool|mixed
     */
    public function saveNum($data, $field)
    {
        $field .= '_num';
        if($this->model->where('user_id', $data['id'])->count()){

            return $this->updateInc(['user_id', $data['id']], $field);
        }

        $updateData = [
            'user_id' => $data['id'],
            $field => 1,

        ];
        return $this->save($updateData);
    }

    /**
     * 更新用户属性数据
     * @param $data
     * @param $field
     * @return bool|mixed
     */
    public function decNum($data, $field)
    {
        $field .= '_num';
        if($this->model->where('user_id', $data['id'])->count()){

            return $this->updateDec(['user_id', $data['id']], $field);
        }

        return false;

    }
}