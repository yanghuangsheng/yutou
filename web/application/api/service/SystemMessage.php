<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/8
 * Time: 14:15
 */

namespace app\api\service;


class SystemMessage extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\SystemMessage;
    }

    /**
     * 列表View
     * @return mixed
     */
    protected function setWithOnView()
    {
        return $this->model->view('SystemMessage','id,type,o_type,o_id,content,status,create_time')
            ->view('User', ['id'=>'user_id','name'=>'user_name','avatar'=>'user_avatar'], 'User.id = SystemMessage.o_user_id', 'LEFT')
            ->order('id', 'desc');
    }

    /**
     * 未读消息
     * @param $user_id
     * @param int $type 0系统 1互动
     * @return float|string
     */
    public function tipsNum($user_id, $type = 0)
    {
        return $this->model->where('type', $type)->where('status', 0)->where('user_id', $user_id)->count();
    }

    /**
     * 更新系统信息状态
     * @param $user_id
     * @param $start_id
     * @return static
     */
    public function clearSystem($user_id, $start_id)
    {
        return $this->model->where('user_id',$user_id)->where('id','<=',$start_id)
            ->where('type', 0)->update(['status'=>1]);
    }

    /**
     * 更新互动信息状态
     * @param $user_id
     * @param $start_id
     * @return static
     */
    public function clearInteraction($user_id, $start_id)
    {
        return $this->model->where('user_id',$user_id)->where('id','<=',$start_id)
            ->where('type', 1)->update(['status'=>1]);
    }

    /**
     * 发送用户互动消息
     * @param $user_id
     * @param $data ['content' 'o_id' 'o_user_id'] 内容 被动ID 动作用户
     * @param $type 1回复帖子 2回复评论 3点赞帖子 4点赞评论 6踩评论
     * @return bool
     */
    public function toUser($user_id, $data, $type)
    {
        $data['user_id'] = $user_id;
        $data['type'] = 1; //互动
        $data['o_type'] = $type;

        return $this->save($data);
    }

    /**
     * 处理输出数据
     * @param $data
     */
    protected function resetListData($data)
    {
        foreach ($data as $key => &$value){
            $value['user_avatar'] = $value['user_avatar'] ? json_decode($value['user_avatar'],1) : userAvatar();
        }
        return $data;
    }

}