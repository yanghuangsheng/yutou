<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/4/30
 * Time: 11:08
 */

namespace app\common\model;


class System extends Base
{
    /**
     * Data写入
     * @param $value
     * @param $data
     * @return string
     */
    protected function setDataAttr($value, $data){

        return $value?json_encode($value):'[]';
    }

    /**
     * Data 输出
     * @param $value
     * @param $data
     * @return mixed
     */
    protected function getDataAttr($value, $data){

        return $value?json_decode($value, true):[];
    }
}