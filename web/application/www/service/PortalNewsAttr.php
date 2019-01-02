<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/26
 * Time: 15:04
 */

namespace app\www\service;


class PortalNewsAttr extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\PortalNewsAttr;
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
        if($this->model->where('news_id', $data['id'])->count()){

            return $this->updateInc(['news_id', $data['id']], $field);
        }

        $updateData = [
            'news_id' => $data['id'],
            $field => 1,

        ];
        return $this->save($updateData);
    }





}