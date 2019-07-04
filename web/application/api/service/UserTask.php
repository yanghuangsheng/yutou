<?php
/**
 * Created by PhpStorm.
 * User: yanghuangsheng
 * Date: 2019-07-02
 * Time: 11:07
 */

namespace app\api\service;


use think\Db;

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
    public function checkTask($user_id, $task_type, $o_id)
    {
        $date_index = returnTodayTime();
        $where = [
            ['user_id', '=', $user_id],
            ['date_index', '=', $date_index],
            ['type', '=', $task_type],
            ['status', '=', 0]
        ];
        $log_where = [
            ['data_index', '=', $date_index],
            ['user_id', '=', $user_id],
            ['type', '=', $task_type],
            ['o_id', '=', $o_id]
        ];

        if($this->model->where($where)->count()) {
            if(\app\common\model\UserTaskLog::where($log_where)->count()) {

                return 0;
            }

            return 1;
        }

        return 0;
    }

    /**
     * 更新任务
     * @param $user_id 用户ID
     * @param $task_type 任务类型
     * @param $o_id 完成任务记录ID
     * @param int $golds_num 竞猜金币
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function updateTaskStatus($user_id, $task_type, $o_id, $golds_num = 0)
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
            $task = $this->model->where($where)->field('id,name,type,num,o_num,reward,reward_type,finish_num')->find();

            //如果是竞猜 判断鱼泡数条件
            if($golds_num && $golds_num != $task['o_num']){
                return false;
            }
            
            //日志
            $task_log = \app\common\model\UserTaskLog::create([
                'user_id' => $user_id,
                'type' => $task_type,
                'o_id' => $o_id,
                'date_index' => $date_index
            ]);

            if(($task['num'] - $task['finish_num']) == 1) {
                //完成任务
                $task->finish_num = $task['finish_num'] + 1;
                $task->status = 1;
                //任务更新
                $task_save = $task->save();

                $field = $task['reward_type']?'scale':'golds';
                $capital = \app\common\model\UserCapital::where('user_id', $user_id)->field('golds,scale')->find();
                $capital->$field = $capital[$field] + $task['reward'];
                $capital_save = $capital->save();

                $capital_log = \app\common\model\UserCapitalLog::create([
                    'user_id' => $user_id,
                    'pay' => '+' . $task['reward'],
                    'residue' => $capital[$field],
                    'explain' => '完成每日任务【'. $task['name'] .'】赠送',
                    'type' => $task['reward_type']
                ]);
                return ['reward'=>$task['reward'], 'reward_type'=>$task['reward_type']];
            }

            //完成次数+1
            $task->finish_num = $task['finish_num'] + 1;
            $task_save = $task->save();

            return [];

        }
    }
}