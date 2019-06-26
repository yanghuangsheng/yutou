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
        $this->order =  ['UserFans.create_time', 'desc'];

    }

    /**
     * 用户的粉丝
     * @return $this
     */
    public function fansView()
    {
        $this->view = $this->model->view('UserFans', 'fans_id as user_id')
            ->view('User', 'name,avatar as user_avatar', 'User.id = UserFans.fans_id');

        return $this;
    }

    /**
     * 用户关注的
     * @return $this
     */
    public function followView()
    {
        $this->view = $this->model->view('UserFans', 'user_id')
            ->view('User', 'name,avatar as user_avatar', 'User.id = UserFans.user_id');

        return $this;

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

    /**
     * 取消关注
     * @param $data
     * @return bool
     */
    public function delFans($data)
    {
        $where = [['user_id', $data['id']], ['fans_id', $data['fans_id']]];
        if($this->model->where($where)->count()){

            if($this->model->where($where)->delete()){
                return true;
            }

        }

        return false;
    }
}