<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/31
 * Time: 16:25
 */

namespace app\api\service;


class UserFans extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\UserFans;
    }

    /**
     * 检测关注
     * @param $userId
     * @param $fansId
     * @return float|string
     */
    public function checkFans($userId, $fansId)
    {
        return $this->model
            ->where('user_id', $userId)
            ->where('fans_id', $fansId)
            ->count();
    }

    /**
     * 关注
     * @param $data
     * @return bool
     */
    public function addFans($data){
        $count = $this->model
            ->where('user_id', $data['id'])
            ->where('fans_id', $data['user_id'])
            ->count();
        if($count){
            $this->error = '已关注！';
            return false;
        }

        $updateData = [
            'user_id' => $data['id'],
            'fans_id' => $data['user_id'],

        ];
        return $this->save($updateData);

    }
}