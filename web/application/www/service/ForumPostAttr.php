<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/29
 * Time: 15:43
 */

namespace app\www\service;


class ForumPostAttr extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\ForumPostAttr;
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
        if($this->model->where('post_id', $data['id'])->count()){

            return $this->updateInc(['post_id', $data['id']], $field)?
                $this->getField([['post_id', '=', $data['id']]], $field):0;
        }

        $updateData = [
            'post_id' => $data['id'],
            $field => 1,

        ];
        return $this->save($updateData)?1:0;
    }
}