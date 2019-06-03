<?php
/**
 * Created by PhpStorm.
 * User: yanghuangsheng
 * Date: 2019-05-30
 * Time: 17:54
 */

namespace app\admin\service;


use think\db\Where;

class Match extends Common
{
    //初始化类
    public function __construct()
    {
        $this->model = new \app\common\model\Match;
        $this->order = ['Match.id', 'desc'];
    }

    /**
     * 列表View
     * @return \app\common\model\Match
     */
    protected function setWithOnView()
    {
        return $this->model->view('Match', 'id,name,type,league_name,open_time,create_time,status,result_status,support_main_num,support_o_num,support_passenger_num')
            ->view('Team Main', ['id'=>'main_id', 'name'=>'main_name', 'image_url'=>'main_image_url'], 'Main.id = Match.main_id')
            ->view('Team Passenger', ['id'=>'passenger_id', 'name'=>'passenger_name', 'image_url'=>'passenger_image_url'], 'Passenger.id = Match.passenger_id');
    }

    /**
     * 重置数据
     * @param $data
     * @return mixed
     */
    protected function resetListData($data)
    {
        foreach ($data as $key => &$value){
            $value['open_time_txt'] = date('Y-m-d H:i:s', $value['open_time']);
            $value['type_name'] = $value['type']?'蓝球':'足球';
            $value['status_txt'] = $value['status']?'<span class="layui-badge layui-bg-green">已处理</span>':'<span class="layui-badge layui-bg-gray">未处理</span>';
            $value['result_status_txt'] = $this->resultStatus($value['result_status']);
            $value['main_image_url'] = '<img src="'. $value['main_image_url'] .'" style="width: 20px; height:20px;">';
            $value['passenger_image_url'] = '<img src="'. $value['passenger_image_url'] .'" style="width: 20px; height:20px;">';

        }

        return $data;
    }

    /**
     * 设置比寒结果
     * @param $param
     * @return bool
     */
    public function saveResult($param)
    {
        if(0 == $this->model->whereNull('result_status')->where('id', $param['id'])->count()){

            $this->error = '不支持重复设置比赛结果';
            return false;
        }

        if($this->model->where('id', $param['id'])->update(['result_status'=>$param['result_value'], 'status'=>1])){
            return true;
        }

        $this->error = '提交失败';
        return false;
    }

    /**
     * 比赛结果
     * @param $value
     * @return mixed|string
     */
    private function resultStatus($value)
    {
        $data = [
            '0' => '<span class="layui-badge layui-bg-warm">平局</span>',
            '1' => '<span class="layui-badge layui-bg-green">主队胜</span>',
            '2' => '<span class="layui-badge layui-bg-normal">客队胜</span>',
            '3' => '<span class="layui-badge layui-bg-gray">未处理</span>',
        ];

        is_numeric($value) || $value = 3;

        return $data[$value];
    }


}