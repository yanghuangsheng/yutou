<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/27
 * Time: 18:09
 */

namespace app\www\service;


class PortalNewsCommentClick extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\PortalNewsCommentClick;
    }

    /**
     * 赞
     * @param $data
     * @return bool
     */
    public function savePraise($data){
        $count = $this->model
            ->where('comment_id', $data['id'])
            ->where('user_id', $data['user_id'])
            ->where('type', 0)
            ->count();
        if($count){
            $this->error = '不能重复点赞！';
            return false;
        }

        $updateData = [
            'comment_id' => $data['id'],
            'user_id' => $data['user_id'],
            'type' => 0,

        ];
        return $this->save($updateData);

    }

    /**
     * 踏
     * @param $data
     * @return bool
     */
    public function saveTread($data){
        $count = $this->model
            ->where('comment_id', $data['id'])
            ->where('user_id', $data['user_id'])
            ->where('type', 1)
            ->count();
        if($count){
            $this->error = '不能重复踩踏！';
            return false;
        }

        $updateData = [
            'comment_id' => $data['id'],
            'user_id' => $data['user_id'],
            'type' => 1,

        ];
        return $this->save($updateData);
    }
}