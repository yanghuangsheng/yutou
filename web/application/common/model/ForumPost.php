<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/10
 * Time: 13:58
 */

namespace app\common\model;


class ForumPost extends Base
{
    protected $type = [
        //'image_url' => 'array',
    ];


    protected function setImageUrlAttr($value, $data)
    {
        if($value[0] == ''){
            return '[]';
        }
        return json_encode($value);
    }

    protected function getImageUrlAttr($value, $data)
    {
        return json_decode($value, true);
    }

    /**
     * 关联用户模型
     * @return $this
     */
    public function user()
    {
        return $this->belongsTo('User', 'user_id')->bind(['user_name'=>'name']);
    }
}