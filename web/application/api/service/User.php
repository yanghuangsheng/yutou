<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/4/1
 * Time: 18:33
 */

namespace app\api\service;


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
    public function getOneInfo($user_id)
    {
        $data = $this->model->view('User', 'id,name,real_name,avatar,birthday,sex,hobby,address,synopsis')
            ->where('id', $user_id)
            ->find();
        //补填没有头像的用户
        $data['avatar'] || $data['avatar'] = userAvatar();
        return $data;
    }

    /**
     * 获取用户信息
     * @param $user_id
     * @return array|null|\PDOStatement|string|\think\Model
     */
    public function getOneArr($user_id)
    {
        $data = $this->model->view('UserAttr', 'praise_num,tread_num,comment_num,post_num,follow_num,fans_num')
            ->where('user_id', $user_id)
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
     * 更新用户信息 (以字段值更新)
     * @param $data ['id', 'name', 'value']
     */
    /**
     * 更新用户信息 (以字段值更新)
     * @param $data ['id', 'name', 'value']
     * @return bool
     */
    public function saveOneInfo($data){
        $saveData = [
            'id' => $data[0],
            'field' => $data[1],
            'value' => $data[2]
        ];
        $result = $this->updateFieldByValue($saveData);
        if($result){
            return true;
        }

        $this->error = '修改失败';
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
        $data = $this->getUserInfo($phone, 'phone');
        if(!isset($data['id'])){
            //如果不存在，创建用户
            $data = [
                'name' => 'yutou_' . random_string('4') . ($this->newsId()+1),
                'phone' => $phone,
                'last_login_time' => time(),
            ];
            if($data['id'] = $this->createUser($data) ){
                return $data;
            }
            else{
                $this->error = '注册失败';
                return false;
            }
        }
        else{
            //记录当前登陆时间
            $this->updateLoginTime($data['id']);
            return $data->toArray();
        }
    }

    /**
     * 获取用户信息
     * @param $value
     * @param string $name
     * @return array|null|\PDOStatement|string|\think\Model
     */
    public function getUserInfo($value, $name = 'phone')
    {
        return $this->model->where($name, $value)->field('id,name,avatar,last_login_time')->find();
    }

    /**
     * 创建新用户
     * @param $data
     * @return bool|mixed
     */
    public function createUser($data)
    {
        if($this->model->allowField(true)->data($data, true)->save()){
            return $this->model['id'];
        }
        else{
            $this->error = '注册失败';
            return false;
        }
    }

    /**
     * 记录登陆时间
     * @param $id
     */
    public function updateLoginTime($id)
    {
        //记录当前登陆时间
        $this->model->update(['id'=>$id, 'last_login_time'=>time()]);
    }
}