<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/26
 * Time: 15:55
 */

namespace app\www\service;


class PortalNewsPraise extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\PortalNewsPraise;
    }

    /**
     * 增加用户点赞记录
     * @param $data
     * @return bool
     */
    public function addUserPraise($data)
    {
        if($this->model->where('news_id', $data['news_id'])->where('user_id', $data['user_id'])->count()){
            $this->error = '不能重复点赞，谢谢你的参与!';
            return false;
        }
        $updateData = [
            'news_id' => $data['news_id'],
            'user_id' => $data['user_id'],

        ];
        if($this->save($updateData)){
            return true;
        }

        $this->error = '点赞失败';
        return false;

    }
}