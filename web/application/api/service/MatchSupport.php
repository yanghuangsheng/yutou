<?php
/**
 * Created by PhpStorm.
 * User: yanghuangsheng
 * Date: 2019-05-29
 * Time: 15:12
 */

namespace app\api\service;


class MatchSupport extends Common
{
    /**
     * 初始化类
     * MatchSupport constructor.
     */
    public function __construct()
    {
        $this->model = new \app\common\model\MatchSupport;
        $this->order = ['id', 'desc'];
    }

    /**
     * 查询列表
     * @return \app\common\model\MatchSupport
     */
    protected function setWithOnView()
    {
        return $this->model->view('MatchSupport', 'id,support_status,golds_num,status')
            ->view('Match', 'league_name,open_time,create_time', 'Match.id = MatchSupport.match_id')
            ->view('Team Main', ['id'=>'main_id', 'name'=>'main_name', 'image_url'=>'main_image_url'], 'Main.id = Match.main_id')
            ->view('Team Passenger', ['id'=>'passenger_id', 'name'=>'passenger_name', 'image_url'=>'passenger_image_url'], 'Passenger.id = Match.passenger_id');
    }
}