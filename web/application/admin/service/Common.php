<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/11/23
 * Time: 11:47
 */

namespace app\admin\service;


class Common extends Base
{

    /**
     * 获取全部数据列表
     * @return mixed array
     */
    public function getListData()
    {
        //存在关联模型设置
        if(method_exists($this, 'setWithOnView')){
            $model = $this->setWithOnView();
        }
        else{
            $model = $this->model;
        }

        //条件
        $this->whereMap && $model = $model->where($this->whereMap);
        //分页
        $this->limit && $model = $model->limit($this->limit);

        //查询请求
        $data['list'] = $model->select();
        //总条数
        $data['count'] = $model->count();
        //存在处理数据设置
        method_exists($this, 'resetListData') && $data['list'] = $this->resetListData($data['list']);


        return $data;
    }

    /**
     * 获取一条数据
     * @param $whereMap 查询的条件
     * @return mixed array
     */
    public function getOneData($whereMap)
    {
        //存在关联模型设置
        if(method_exists($this, 'setWithOnView')){
            $model = $this->setWithOnView();
        }
        else{
            $model = $this->model;
        }

        //查询请求
        $data = $model->where(is_array($whereMap)?$whereMap:[[$this->keyId, '=', $whereMap]])->find();
        //存在处理数据设置
        method_exists($this, 'resetFindData') && $data = $this->resetFindData($data);

        return $data;
    }

    /**
     * 获取某个字段值
     * @param $data 条件
     * @param $field 字段
     * @return mixed
     */
    public function getOneField($data,$field)
    {
        //查询
        return $this->model->where(is_array($data)?$data:[[$this->keyId, '=', $data]])->value($field);
    }

    /**
     * 删除一条或多条数据
     * @param $id 删除对像键值，多个传数组
     * @return bool
     */
    public function delete($id)
    {
        is_array($id) && $id = implode(',',$id);
        if($this->model->destroy($id)){
            return true;
        }

        return false;
    }

    /**
     * 单独更新字段
     * @param $data array [id,field,value]
     * @return bool
     */
    public function updateFieldByValue($data)
    {
        if($this->model->update(['id'=>$data['id'], $data['field']=>$data['value']])){
            return true;
        }

        return false;
    }

    /**
     * 更新与新增
     * @param $postData array 要更新的数据
     * @param int $isUpdate 0新增 1更新
     * @return bool
     */
    public function save($postData, $isUpdate = 0)
    {

        //如果设置可更新字段
        method_exists($this, 'setAllowField') && $this->model->allowField($this->setAllowField());
        if ($isUpdate) {
            //更新
            if ($this->model->save($postData, ['id' => $postData['id']])) {
                //额外更新
                if(method_exists($this, 'setSaveUpdate')){
                    $this->setSaveUpdate($postData, $this->model);
                }
                return true;
            }

        } else {
            //新增
            if ($this->model->data($postData, true)->save()) {
                //额外新增
                if(method_exists($this, 'setSaveAdd')){
                    $this->setSaveAdd($postData, $this->model);
                }
                return true;
            }

        }

        return false;
    }

}