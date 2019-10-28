<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/27
 * Time: 18:06
 */

namespace app\www\service;


class PortalNewsCommentAttr extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\PortalNewsCommentAttr;
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
        if($this->model->where('comment_id', $data['id'])->count()){

            return $this->updateInc(['comment_id', $data['id']], $field);
        }

        $updateData = [
            'comment_id' => $data['id'],
            $field => 1,

        ];
        return $this->save($updateData);
    }
}