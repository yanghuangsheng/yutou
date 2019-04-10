<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/29
 * Time: 16:05
 */

namespace app\api\service;


class ForumPostPraise extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\ForumPostPraise;
    }

    /**
     * 增加用户点赞记录
     * @param $data
     * @return bool
     */
    public function addUserPraise($data)
    {
        if($this->model->where('post_id', $data['post_id'])->where('user_id', $data['user_id'])->count()){
            $this->error = '不能重复点赞，谢谢你的参与!';
            return false;
        }
        $updateData = [
            'post_id' => $data['post_id'],
            'user_id' => $data['user_id'],

        ];
        if($this->save($updateData)){
            return true;
        }

        $this->error = '点赞失败';
        return false;

    }
}