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
        $logic->formatOneLotteryList();

        $data['news_list'] = $this->newsList($logic);
        $data['seven_list'] = $logic->sevenDayHotData();
        $data['top_list'] = $logic->sevenDayTopData();
        $data['lottery_list'] = $logic->lotteryList();
        $data['ad_carousel'] = $logic->getCarousel();
        $data['ad_banner'] = $logic->getBanner(3);
//        print_r($data['lottery_list']);

        $this->init([
            'keywords' => '福彩,体彩,开奖结果,时时彩,足球,双色球,大乐透,3d,中超,比分直播,电竞,lol,英雄联盟,王者荣耀',
            'description' => '鱼头网提供彩票资讯、足球资讯、电竞资讯等资讯类服务，同时还提供各种娱乐型的竞猜服务，并致力于为彩民、球迷以及电竞爱好者提供一个丰富的社区',
        ],1);

        $this->assign('data',$data);

        return $this->fetch();
    }

    /**
     * 新闻列表
     * @return array
     */
    protected function newsList($logic)
    {
        $data['data'][] = $logic->getList(0); //最新
        $data['data'][] = $logic->getList(9); //竞技
        $data['data'][] = $logic->getList(10); //数字
        $data['data'][] = $logic->getList(11); //电竞
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