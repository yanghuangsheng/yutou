<?php
/**
 * Created by PhpStorm.
 * User: yanghuangsheng
 * Date: 2019-05-30
 * Time: 18:38
 */

namespace app\admin\logic;

use app\admin\service\Match as MatchService;
use app\admin\service\MatchSupport as MatchSupportService;
use app\admin\service\UserCapital as UserCapitalService;
use app\admin\service\UserCapitalLog as UserCapitalLogService;
use app\admin\service\SystemMessage as SystemMessageService;
use think\Db;

class Match extends Base
{
    /**
     * 获取列表
     * @return array
     */
    public function getList()
    {
        $this->getListJson();

        return [];
    }

    /**
     * 提交处理结果
     */
    public function saveResult()
    {
        if($this->isAjax()) {
            $param = $this->param();

            Db::startTrans();
            $service = new MatchService;
            $error = '处理中奖数据出错';
            if($service->saveResult($param)){

                $matchSupportService = new MatchSupportService;
                $userCapitalService = new UserCapitalService;
                $userCapitalLogService = new UserCapitalLogService;
                $systemMessageService = new SystemMessageService;

                $supportData = $matchSupportService->userSupportList($param['id']);

                $time = time();
                $foreachVal = true;
                $logData = []; // 日志
                $userMessage = []; //用户信息
                foreach ($supportData as $key => $value){

                    $updateData = [
                        'status' => 2,
                        'settlement_golds_num' => 0,
                        'settlement_golds_time' => $time,
                    ];

                    if($value['support_status'] == $param['result_value']){
                        $updateData['status'] = 1;
                        $updateData['settlement_golds_num'] = $value['golds_num'] * 2;

                        if($goldsNum = $userCapitalService->saveGolds($value['user_id'], $updateData['settlement_golds_num'])){

                            $logData[] = [
                                'user_id' => $value['user_id'],
                                'pay' => '+' . $updateData['settlement_golds_num'],
                                'residue'=> $goldsNum,
                                'explain'=> '赛事预测中奖，赠送鱼币',
                            ];
                            $resultSupportArr = ['平局','主队胜','客队胜'];
                            $userMessage[] = [
                                'user_id' => $value['user_id'],
                                'content' => '你参与的竞猜【'. $value['name'] .'】，'. $resultSupportArr[$param['result_value']] .'，恭喜获得'. $updateData['settlement_golds_num'] .'鱼币。',
                                't_type' => 2
                            ];
//                            json_encode($logData);
//                            $userCapitalLogService->giveGoldsLog($logData);
                        }else{
                            $foreachVal = false;
//                            $error = '$goldsNum: ' . $goldsNum;
                            break;//出错终止
                        }

                    }

                    if(!$matchSupportService->userUpdate($value['id'], $updateData)){
                        $foreachVal = false;
//                        $error = '$updateData: ' . json_encode($updateData);
                        break;//出错终止
                    }
                }

                if($logData){
                    $resultArr = $userCapitalLogService->allGoldsLog($logData);
                    $systemMessageService->saveToMessage($userMessage);
                    if(!$resultArr){
//                        json_encode($resultArr);
//                        $error = 'resultArr:' . json_encode($resultArr);
                        $foreachVal = false;
                    }
                }


                if($foreachVal){
                    Db::commit();
                    $this->resultJson(0, '提交成功');
                }

            }

            Db::rollback();
            $this->resultJson(-1, $service->getError()?$service->getError():$error);

        }
    }

    /**
     * 获取数据列表
     */
    protected function getListJson()
    {
        if($this->isAjax()){
            $param = $this->param();
            $where = [];

            $service = new MatchService;
            $data = $service->initWhere($where)->initLimit($param['page'], $param['limit'])->getListData();

            $this->resultJson(0, '获取成功', $data);
        }
    }

}