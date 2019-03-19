<?php
/**
 * Created by PhpStorm.
 * User: YANG
 * Date: 2019/3/13
 * Time: 14:32
 */

namespace app\api\controller\v1;

use app\api\logic\News as news;
use app\api\logic\Ad as ad;

class Index extends Base
{

    //获取首页所有肉容
    public function all()
    {
        $data = [
            'banner' => $this->banner(),
            'baroadcast' => $this->broadcast(),
            'hot_news' => $this->hotNews(),
            'news_column' => $this->newsColumn()
        ];

        return showResult(0, '', $data);
    }

    //轮播图
    protected function banner()
    {
        return (new ad)->getCarousel();
    }

    //广播
    protected function broadcast()
    {
        return [];

    }

    //热门资讯
    protected function hotNews()
    {
        return (new news)->sevenDayTopData();

    }

    //资讯栏目
    protected function newsColumn()
    {
        $news = new news;
        $data = [
            ['category_id'=>0, 'title'=>'最新文章'],
            ['category_id'=>9, 'title'=>'竞彩大神'],
            ['category_id'=>10, 'title'=>'数字彩讯'],
            ['category_id'=>11, 'title'=>'电竞地带']
        ];
        $startId = $news->getNewsId();
        foreach ($data as $key => &$value){
            $reData = $news->getList($value['category_id']);
            $value['list'] = $reData['list'];
            $value['count'] = $reData['count'];
            $value['start_id'] = $startId;
        }

        return $data;

    }
}