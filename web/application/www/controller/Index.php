<?php

/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2018/12/10
 * Time: 15:00
 */
namespace app\www\controller;

use app\www\logic\News;

class Index extends Base
{
    public function index()
    {
        $logic = new News;
        $this->getFormatNews($logic);

        $data['news_list'] = $this->newsList($logic);
        $data['seven_list'] = $logic->sevenDayHotData();
        $data['top_list'] = $logic->sevenDayTopData();
        $data['lottery_list'] = $logic->lotteryList();
        //print_r($data['lottery_list']);
        $this->assign('data',$data);
        return $this->fetch();
    }

    /**
     * 新闻列表
     * @return array
     */
    protected function newsList($logic)
    {
        $data['data'][] = $logic->getList(9); //竞技
        $data['data'][] = $logic->getList(10); //数字
        $data['data'][] = $logic->getList(11); //其他
        $data['start_id'] =  $logic->getNewsId(); //用于获取下一页数据，预防有新数据重复出现
        return $data;
    }


    /**
     * 加载分类新闻
     * @return mixed
     */
    protected function getFormatNews($logic)
    {
        if($this->isFormat('news')){
            return $logic->formatNews();
        }
    }

}