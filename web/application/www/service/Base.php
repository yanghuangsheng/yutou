<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/21
 * Time: 13:31
 */

namespace app\www\service;


class Base
{
    protected $model; //当前数据模型
    protected $view = ''; //特殊模型
    protected $keyId = 'id'; //模型默订主键
    protected $order = [];
    protected $limit = 0;
    protected $whereMap = [];
    protected $group = '';
    protected $error = '';

    /**
     * 外部获取错误信息
     * @return string
     */
    public function getError(){

        return $this->error;
    }

    /**
     * 设置分页
     * @param int $page 页码
     * @param int $listCount 每页列表数量
     * @return $this
     */
    public function initLimit($page = 0, $listCount = 15)
    {

        $this->limit = ($page - 1) * $listCount . ',' . $listCount;

        return $this;
    }

    /**
     * 设置分组
     * @param $field 分组字段
     * @return $this
     */
    public function initGroup($field)
    {
        $this->group = $field;
        return $this;
    }

    /**
     * 设置查询条件
     * @param array $data 查询的条件
     * @return $this
     */
    public function initWhere($data = [])
    {
        $this->whereMap = $data;

        return $this;
    }


}