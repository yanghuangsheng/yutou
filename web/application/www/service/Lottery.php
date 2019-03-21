<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/2
 * Time: 10:46
 */

namespace app\www\service;


class Lottery extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\SpiderLottery;
        $this->order = ['id', 'desc'];
    }

    /**
     * 彩票分类列表
     */
    public function allList()
    {
        $data = (new \app\common\model\SpiderLotteryCategory)->where('parent_id', '>', 0)
            ->where('status', '=', 1)
            ->field('id,name')->order('parent_id,id', 'asc')->select();

        foreach ($data as $key => &$value){
            $lottery =  $this->model->where('category_id', $value['id'])->order('id', 'desc')
                ->field('lottery_no,open_code,open_time')->find();
            if($lottery){
                $value['no'] = $lottery['lottery_no'];
                $code = $lottery['open_code'];
                $ext = '';
                if(strpos($lottery['open_code'],'+') !== false){
                    list($code,$ext) = explode('+', $lottery['open_code']);
                }
                $value['open_code'] = $code?explode(',', $code):[];
                $value['open_code_ext'] = $ext?explode(',', $ext):[];
                $value['open_time'] = $lottery['open_time'];
            }else{
                $value['no'] = '';
                $value['open_code'] = [];
                $value['open_code_ext'] = [];
                $value['open_time'] = '';
            }

        }

        return $data;
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