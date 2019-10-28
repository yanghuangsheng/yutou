<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/21
 * Time: 11:03
 */

namespace app\api\logic;


use app\api\exception\SuccessException;

class Lottery extends Base
{
    /**
     * 彩票最新开奖列表
     * @throws SuccessException
     */
    public function getList()
    {
        $data = (new \app\api\service\Lottery)->allList();

        throw new SuccessException('success', $data);
    }

    /**
     * 彩票单条开奖列表
     * @throws SuccessException
     */
    public function formatOneLotteryList()
    {

        $param = $this->param();
        isset($param['page']) || $param['page'] = 1;

        $service = new \app\api\service\Lottery;
        $data = $service->getLotteryName($param['lottery_id']);
        $data['start_id'] = isset($param['start_id'])?$param['start_id']:$service->newsId();
        $where = [
            ['category_id', '=', $param['lottery_id']]
        ];
        isset($param['start_id']) && $where[] = ['id', '<=', $param['start_id']];

        $list = $service->initField('lottery_no,open_code,open_time')->initWhere($where)
            ->initLimit($param['page'])->initOrder(['lottery_no', 'desc'])->getListData();
        $data['list'] = $list['list']->toArray();

        foreach ($data['list'] as $key => &$value)
        {
            $value['week'] = getWeek($value['open_time']);

            $code = $value['open_code'];
            $ext = '';
            if(strpos($value['open_code'],'+') !== false){
                list($code,$ext) = explode('+', $value['open_code']);
            }
            $value['open_code'] = $code?explode(',', $code):[];
            $value['open_code_ext'] = $ext?explode(',', $ext):[];
        }

        throw new SuccessException('success', $data);

    }

    /**
     * 获取彩票名称
     * @param $id
     * @return array
     */
    public function getLotteryName($id)
    {
        $data = ['id'=>$id];
        $data['name'] = (new \app\common\model\SpiderLotteryCategory)->where('id', '=', $id)->value('name');

        return $data;
    }
}