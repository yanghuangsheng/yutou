<?php
/**
 * Created by PhpStorm.
 * User: yanghuangsheng
 * Date: 2019-05-30
 * Time: 18:38
 */

namespace app\admin\logic;

use app\admin\service\Match as MatchService;
use app\common\model\MatchSupport as MatchSupportModel;
use app\admin\service\UserCapital as UserCapitalService;
use app\admin\service\UserCapitalLog as UserCapitalLogService;
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

                $matchSupportModel = new MatchSupportModel;
                $userCapitalService = new UserCapitalService;
                $userCapitalLogService = new UserCapitalLogService;

                $supportData = $matchSupportModel->where('match_id', $param['id'])->where('status', 0)
                    ->field('id,user_id,support_status,golds_num')
                    ->select()->toArray();
                $time = time();
                $foreachVal = true;
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
                            $foreachVal = false;
                            $logData = [
                                'user_id' => $value['user_id'],
                                'pay' => '+' . $updateData['settlement_golds_num'],
                                'residue'=> $goldsNum,
                                'explain'=> '赛事预测中奖，赠送鱼币',
                            ];
                            json_encode($logData);
                            $userCapitalLogService->giveGoldsLog($logData);
                        }else{
                            $foreachVal = false;
                            //$error = '$goldsNum: ' . $goldsNum;
                            break;//出错终止
                        }

                    }

                    if(!$matchSupportModel->where('id', $value['id'])->update($updateData)){
                        $foreachVal = false;
                        //$error = '$updateData: ' . json_encode($updateData);
                        break;//出错终止
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