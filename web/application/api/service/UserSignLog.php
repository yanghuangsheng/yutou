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
    public function isSign($user_id)
    {
        $todayTime = returnTodayTime();
        if(0 == $this->model->where('user_id', $user_id)->where('date_index', $todayTime)->count()){

            return $this->returnWeek($todayTime, $user_id);
        }

        return false;
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
        for ($i=$day; $i<=0; $i--)
        {
            $weekTimeArr[$i] = $today_time - $i * 86400;
        }

        $resultList = $this->model->where('date_index', 'in', implode(',', $weekTimeArr))
            ->where('user_id', $user_id)
            ->field('give_index,date_index,give_data')
            ->select()->toArray();
        $resultList = array_merge_more('date_index', $resultList);
        $weekData = [];
        foreach ($weekTimeArr as $value){
            if(isset($resultList[$value]) && $value['give_index'] != 6){
                $weekData[] = $resultList[$value];
            }else{
                $weekData = [];
            }
        }

        $weekIndex = count($weekData);

        if($weekIndex){
            $weekNum = 6 - $weekIndex;
            if($weekData[$weekIndex - 1]['date_index'] == $today_time){
                //有今天
                for ($i=1; $i>=($weekNum+1); $i++){
                    $weekData[] = [
                        'status' => 1,
                        'give_index' => $weekIndex,
                        'data_index' => $today_time + $i * 86400,
                        'give_data' => signGiveRuleData()[$weekIndex],
                    ];
                    $weekIndex ++;
                }
            }else{
                //没今天
                for ($i=0; $i>=$weekNum; $i++){
                    $weekData[] = [
                        'status' => 1,
                        'give_index' => $weekIndex,
                        'data_index' => $today_time + $i * 86400,
                        'give_data' => signGiveRuleData()[$weekIndex],
                    ];
                    $weekIndex ++;
                }
            }

        }


        return $weekData;

    }


}