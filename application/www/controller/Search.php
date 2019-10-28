<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/1/3
 * Time: 14:22
 */

namespace app\www\controller;


class Search extends Base
{

    public function index()
    {
        $logic = new \app\www\logic\Search;
        $this->getFormatList($logic);

        $news = new \app\www\logic\News;

        $data['news_list'] = $this->getList($logic);
        $data['seven_list'] = $news->sevenDayHotData();
        $data['lottery_list'] = $news->lotteryList();
        $data['ad_banner'] = $news->getBanner(3);


        $this->assign('data', $data);
        $this->init(['title'=>'搜索【' . $data['news_list']['q'] . '】']);

        return $this->fetch();
    }


    protected function getList($logic)
    {
        $data = $logic->getList();
        $data['start_id'] = $logic->getNewId();
        return $data;
    }

    /**
     * 加载更多
     * @param $logic
     * @return mixed
     */
    protected function getFormatList($logic)
    {
        if($this->isFormat()) {
            return $logic->formatList();
        }
    }

}