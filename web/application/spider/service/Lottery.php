<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/10
 * Time: 16:23
 */

namespace app\spider\service;


class Lottery extends Base
{
    /**
     * 执行采集任务
     * @param $rule_id
     * @param $model
     * @return bool
     */
    public function categoryLotteryRule($rule_id, $model)
    {
        $pattern = $model->find($rule_id);
        //dump($pattern);

        $this->url = $pattern['api_url'];

        if($this->curlGet() === false){
            echo '获取数据出错';
            return false;
        }

        if($data = json_decode($this->result, true)){
            //dump($data['data']);
            $newData = [];
            //补充数据
            foreach ($data['data'] as $key => $value){
                $newData[] = [
                    'category_id' => $pattern['category_id'],
                    'lottery_no' => $value['expect'],
                    'open_code' => $value['opencode'],
                    'open_time' => $value['opentimestamp'],
                ];
            }

            $this->saveAddLottery($newData);

        }

    }

    /**
     * 保存数据
     * @param $data
     * @return bool
     */
    protected function saveAddLottery($data)
    {
        $model = new \app\common\model\SpiderLottery;

        //存放新的数据
        $newAddData = [];
        foreach ($data as $key => $value){
            if(0 == $model->where('open_time', $value['open_time'])->where('category_id', $value['category_id'])->count()){
                $newAddData[] = $value;
            }else{
                break;
            }
        }

        if($model->saveAll($newAddData)){
            return true;
        }

        return false;
    }
}