<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/29
 * Time: 15:59
 */

namespace app\api\service;


class ForumPostCommentAttr extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\ForumPostCommentAttr;
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
        $count = $this->model->where('comment_id', $data['id'])->count();
        if($count){

            return $this->updateInc(['comment_id', $data['id']], $field);
        }

        $updateData = [
            'comment_id' => $data['id'],
            $field => 1,

        ];
        return $this->save($updateData);
    }
}