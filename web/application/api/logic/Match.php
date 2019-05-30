<?php
/**
 * Created by PhpStorm.
 * User: yanghuangsheng
 * Date: 2019-05-29
 * Time: 15:45
 */

namespace app\api\logic;

use app\api\service\UserCapital;
use app\api\service\UserCapitalLog;
use app\api\service\Match as MatchService;
use app\api\service\MatchSupport as MatchSupportService;
use think\Db;

class Match extends Base
{
    /**
     * 提交预测
     */
    public function submitSupport()
    {
        $this->checkToken();
        $param = $this->param();
        //提交数据验证

        //用户ID
        $saveData = [
            'user_id' => $this->tokenData['id'],
            'match_id' => $param['match_id'],
            'support_status' => $param['status'],
            'golds_num' => $param['golds_num'],

        ];

        $matchService = new MatchService;
        $matchSupportService = new MatchSupportService;
        $userCapital = new UserCapital;
        $userCapitalLog = new UserCapitalLog;

        Db::startTrans();
//        if($matchSupportService->getCount([['match_id', '=', $saveData['match_id']], ['user_id', '=', $saveData['user_id']]]) > 0){
//            return showResult(-1, '已竞猜过了');
//        }

        $goldsNum = $userCapital->deductGolds($saveData['user_id'], $saveData['golds_num']);
        if($goldsNum === false){
            Db::rollback();
            return showResult(-1, $userCapital->getError());
        }
        //记录消费日志
        $logResult = $userCapitalLog->giveGoldsLog(
            [
                'user_id' => $saveData['user_id'],
                'pay' => '-'.$saveData['golds_num'],
                'residue'=> $goldsNum,
                'explain'=> '预测消费金币',
            ]
        );
        //支持加1
        $indField = ['support_o_num','support_main_num','support_passenger_num'];
        $incResult = $matchService->updateInc(['id', $saveData['match_id']], $indField[$saveData['support_status']]);

        //预测
        if($logResult &&  $incResult && $matchSupportService->save($saveData)){
            Db::commit();
            return showResult(0, '预测成功');
        }

        Db::rollback();
        return showResult(-1, '预测失败');

    }

    /**
     * 预测记录
     */
    public function supportLog()
    {

    }
}