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

        Db::startTrans();
        $matchSupportService = new MatchSupportService;
        $userCapital = new UserCapital;
        $userCapitalLog = new UserCapitalLog;

        $goldsNum = $userCapital->deductGolds($saveData['user_id'], $saveData['golds_num']);
        if($goldsNum === false){
            Db::rollback();
            return showResult(-1, $userCapital->getError());
        }
        //记录消费日志
        $userCapitalLog->giveGoldsLog(
            [
                'user_id' => $saveData['user_id'],
                'pay' => $saveData['golds_num'],
                'residue'=> $goldsNum,
                'explain'=> '预测消费金币',
            ]
        );

        //预测
        if($matchSupportService->save($saveData)){

            Db::commit();
            return showResult(0, '预测成功');
        }

        Db::rollback();
        return showResult(-1, '预测失败');

    }
}