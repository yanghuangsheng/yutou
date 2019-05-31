<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/22
 * Time: 15:39
 */

namespace app\admin\service;


class Base
{
    protected $model; //当前数据模型
    protected $keyId = 'id'; //模型默订主键
    protected $whereMap = []; //查询模型条件
    protected $limit = 0; //默认不分页
    protected $order = [];
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
     * 设置查询条件
     * @param array $data 查询的条件
     * @return $this
     */
    public function initWhere($data = [])
    {
        $this->whereMap = $data;

        return $this;
    }

    /**
     * 设置排序
     * @param array $data
     * @return $this
     */
    public function initOrder($data = [])
    {
        $data && $this->order = $data;
        return $this;
    }

}