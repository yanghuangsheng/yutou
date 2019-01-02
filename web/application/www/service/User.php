<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/21
 * Time: 17:30
 */

namespace app\www\service;


class User extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\User;
    }

    /**
     * 获取一条用户信息
     * @param $user_id
     * @return array|null|\PDOStatement|string|\think\Model
     */
    public function getOneData($user_id)
    {
        $data = $this->model->where('id', $user_id)
            ->field('id,name,real_name,avatar,birthday,sex,hobby,address,synopsis')
            ->find();
        return $data;
    }

    /**
     * 保存绑定手机
     * @param $phone
     * @param $id
     * @return bool
     */
    public function saveBindPhone($phone, $id)
    {
        if($this->model->where('phone', $phone)->count()){
            $this->error = '手机已经被绑定，不能重复绑定';
            return false;
        }
        $result = $this->model->allowField(['phone'])
            ->save(['phone' => $phone], ['id' => $id]);
        if($result){
            return true;
        }

        $this->error = '绑定失败';
        return false;
    }

    /**
     * 更新用户信息
     * @param $data
     * @param $id
     * @return bool
     */
    public function saveInfo($data, $id)
    {
         $result = $this->model->allowField(['name','real_name','avatar','birthday','sex','hobby','address','synopsis'])
            ->save($data, ['id' => $id]);
         if($result){
             return true;
         }

         $this->error = '保存失败';
         return false;
    }

    /**
     * 处理注册与登陆
     * @param $phone
     * @param array $param
     * @return array|bool|null|\PDOStatement|string|\think\Model
     */
    public function saveLogin($phone, $param = [])
    {
        $data = $this->model->where('phone', $phone)->field('id,name,avatar,last_login_time')->find();
        if(!isset($data['id'])){
            //如果不存在，创建用户
            $data = [
                'name' => 'yutou_' . random_string('4') . $this->newsId(),
                'phone' => $phone,
                'last_login_time' => time(),
            ];
            if($this->model->allowField(true)->data($data, true)->save()){
                $data['id'] = $this->model['id'];
            }
            else{
                $this->error = '注册失败';
                return false;
            }

            return $data;
        }
        else{
            //记录当前登陆时间
            $this->model->update(['id'=>$data['id'], 'last_login_time'=>time()]);
            return $data->toArray();
        }

    }
}