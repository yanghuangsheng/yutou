<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/31
 * Time: 17:28
 */

namespace app\www\service;


class UserCollection extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\UserCollection;
    }


    public function checkPost(){

    }

    /**
     * 收藏
     * @param $data
     * @return bool
     */
    public function addCollect($data){
        $count = $this->model
            ->where('o_id', $data['id'])
            ->where('user_id', $data['user_id'])
            ->where('type', $data['type'])  // 0新闻 1贴子
            ->count();
        if($count){
            $this->error = '已收藏过了！';
            return false;
        }

        $updateData = [
            'o_id' => $data['id'],
            'user_id' => $data['user_id'],
            'type' => $data['type'],

        ];
        return $this->save($updateData);

    }
}