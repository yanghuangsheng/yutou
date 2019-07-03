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
    public function updateTaskStatus($user_id, $task_type)
    {
        $date_index = returnTodayTime();
        $where = [
            ['user_id', '=', $user_id],
            ['date_index', '=', $date_index],
            ['type', '=', $task_type],
            ['status', '=', 0]
        ];
        if($this->model->where($where)->count()) {
            //
            $findData = $this->model->where($where)->field('id,num,')->find();
        }
    }
}