<?php
/**
 * Created by PhpStorm.
 * User: yanghuangsheng
 * Date: 2019-07-02
 * Time: 11:07
 */

namespace app\api\service;


class UserTask extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\UserTask;
        $this->order =  ['id', 'desc'];

    }

    /**
     * 初始化任务
     * @param $user_id
     * @param $date_index
     * @return bool|\think\Collection
     * @throws \Exception
     */
    public function initTask($user_id, $date_index)
    {
        $count = $this->model->where('date_index', '=', $date_index)->where('user_id', '=', $user_id)->count();
        if($count == 0){
            $task_list = randomTaskData();
            foreach ($task_list as $key => &$value) {
                $value['user_id'] = $user_id;
                $value['date_index'] = $date_index;
            }
            //print_r($task_list);
            return $this->model->saveAll($task_list);
        }

        return false;
    }

    /**
     * 检测任务
     * @param $user_id
     * @param $task_type
     * @return bool
     */
    public function checkTask($user_id, $task_type)
    {
        $date_index = returnTodayTime();
        $where = [
            ['user_id', '=', $user_id],
            ['date_index', '=', $date_index],
            ['type', '=', $task_type],
            ['status', '=', 0]
        ];
        if($this->model->where($where)->count()){

            return true;
        }

        return false;
    }

    /**
     * 更新任务
     */
    public function updateTaskStatus($user_id, $task_type, $o_id)
    {
        $date_index = returnTodayTime();
        $where = [
            ['user_id', '=', $user_id],
            ['date_index', '=', $date_index],
            ['type', '=', $task_type],
            ['status', '=', 0]
        ];
        if($this->model->where($where)->count()) {
            //获取任务
            $task = $this->model->where($where)->field('id,type,num,o_num,reward,reward_type,finish_num')->find();
            //完成次数+1
            $task->finish_num = ['inc', 1];

            if(($task['num'] - $task['finish_num']) == 1) {
                //完成任务
                $task->status = 1;
                //赠送相关
                $task-save();
                $field = $task['reward_type']?'golds':'scale';

                $capital = \app\common\model\UserCapital::where('user_id', $user_id)->field('golds,scale')->find();
                $capital->$field = ['inc', $task['reward']];
                $capital->save();
                \app\common\model\UserCapitalLog::create([
                    'user_id' => $user_id,
                    'pay' => '+'.$task['reward'],
                    'residue' => $capital[$field],
                    'explain' => ''
                ]);
                return ['reward'=>$task['reward'], 'reward_type'=>$task['reward_type']];
            }

            $task-save();
            return [];

        }
    }
}