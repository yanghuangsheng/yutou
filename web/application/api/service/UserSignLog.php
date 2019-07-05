<?php
/**
 * Created by PhpStorm.
 * User: yanghuangsheng
 * Date: 2019-06-11
 * Time: 14:56
 */

namespace app\api\service;


class UserSignLog extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\UserSignLog;
    }

    /**
     * 判断签到
     * @param $user_id
     * @return array|bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function checkTodaySign($user_id)
    {
        $todayTime = returnTodayTime();
        if(0 == $this->model->where('user_id', $user_id)->where('date_index', $todayTime)->count()){
            return $this->returnWeek($todayTime, $user_id);
        }

        return false;
    }

    /**
     * 获取签到详情
     * @param $user_id
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getTodayDetails($user_id)
    {
        $todayTime = returnTodayTime();

        $data['status'] = $this->model->where('user_id', $user_id)->where('date_index', $todayTime)->count();
        $data['today_list'] = $this->returnWeek($todayTime, $user_id);

        if($user_id){
            $data['task_list'] = \app\common\model\UserTask::where('user_id', '=', $user_id)
                ->where('date_index', '=', $todayTime)
                ->field('type,name,num,o_num,reward,reward_type,finish_num')
                ->select();
        }else{
            $data['task_list'] = randomTaskData(1);
        }


        return $data;

    }

    /**
     * 签到
     * @param $user_id
     * @return array|bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function onTodaySign($user_id)
    {
        $todayTime = returnTodayTime();
        $data = $this->model
            ->where('user_id', $user_id)
            ->where('date_index', $todayTime - 86400)
            ->field('give_index,date_index')->find();
        //签到数据
        $weekIndex = $data?$data['give_index']+1:0;
        ($weekIndex == 7) && $weekIndex = 0;
        $giveData = signGiveRuleData()[$weekIndex];

        $saveData = [
            'user_id' => $user_id,
            'give_index' => $weekIndex,
            'date_index' => $todayTime,
            'give_data' => $giveData,
        ];

        if($this->save($saveData)){

            return $saveData;
        }else{

            return false;
        }
    }

    /**
     * 签到记录
     * @param $today_time 今天时间
     * @param $user_id 用户ID
     * @param int $day 天数
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function returnWeek($today_time, $user_id, $day = 6)
    {
        $weekTimeArr = [];
        for ($i=$day; $i>=0; $i--)
        {
            $weekTimeArr[] = $today_time - ($i * 86400);
        }

        $resultList = $this->model->whereIn('date_index', implode(',', $weekTimeArr))
            ->where('user_id', $user_id)
            ->field('give_index,date_index,give_data')
            ->select();
        $resultList = keyData($resultList,'date_index');


        $weekData = [];
        foreach ($weekTimeArr as $value){
            echo isset($resultList[$value]). ' && ' . $value['give_index'] . "<6\n";
            if(isset($resultList[$value]) && $value['give_index'] < 6){

                $findData = $resultList[$value];
                $findData['status'] = 1;
                $weekData[] = $findData;

            }else if($value != $today_time){
                $weekData = [];
            }
        }

        $weekIndex = count($weekData);

        $weekNum = 6 - $weekIndex;
        if(isset($weekData[$weekIndex - 1]['date_index']) && $weekData[$weekIndex - 1]['date_index'] == $today_time){
            //有今天
            for ($i=1; $i<=($weekNum+1); $i++){
                $weekData[] = [
                    'status' => 0,
                    'give_index' => $weekIndex,
                    'date_index' => $today_time + $i * 86400,
                    'give_data' => signGiveRuleData()[$weekIndex],
                ];
                $weekIndex ++;
            }
        }else{
            //没今天
            for ($i=0; $i<=$weekNum; $i++){
                $weekData[] = [
                    'status' => 0,
                    'give_index' => $weekIndex,
                    'date_index' => $today_time + $i * 86400,
                    'give_data' => signGiveRuleData()[$weekIndex],
                ];
                $weekIndex ++;
            }
        }

        return $weekData;

    }


}